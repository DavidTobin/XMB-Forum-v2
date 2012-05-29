<?php

namespace XMB\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormError;
use XMB\ForumBundle\Form\Type\ThreadFormType;
use XMB\ForumBundle\Entity\Thread AS ThreadEntity;
use XMB\ForumBundle\Form\Type\ThreadReplyFormType;
use XMB\ForumBundle\Form\Type\PostFormType;
use XMB\ForumBundle\Entity\Post;
use XMB\ForumBundle\Model\Thread;


class ThreadController extends Controller
{
    
    public function indexAction($slug, $action, Request $request)
    {
        $action .= 'Action';
        
        // Check if any action properties exist, otherwise treat as view thread.
        if (method_exists($this, $action)) {                        
            return $this->$action($slug, $action, $request);
        }
        
        $threadm    = new Thread($this->get('database_connection'));
        $thread     = $threadm->fetchThread($slug); 
        $replies    = $threadm->fetchReplies($thread);           
        
        if (!$thread) {
            return $this->forward('XMBForumBundle:Error:index', array(
                'error' => 'The thread you are looking for could not be found!'
            ));
        }
        
        if ($request->isXmlHttpRequest()) {
            $response = new Response(json_encode(array(
                'thread'    => $thread,
                'replies'   => $replies               
            )));
            
            $response->headers->set('Content-Type', 'application/json');
            
            return $response;
        } else {
            // Generate reply form
            $post = new Post();            
            $form = $this->createForm(new ThreadReplyFormType(), $post);
            
            if ($request->getMethod() == 'POST') {
                $form->bindRequest($request);
                
                if ($form->isValid() && $thread['status'] != 0) {
                    // Get entity manager
                    $em = $this->getDoctrine()->getEntityManager();
                    
                    $user = $this->get('security.context')->getToken()->getUser();
                    
                    // Set necessary post values
                    $post->setUserid($user->getId());
                    $post->setThreadid($thread['threadid']);
                    $post->setParentid($thread['id']);
                                    
                    $em->persist($post);      
                    $em->flush();
                    
                    // Update thread last activity and replies
                    $threadentity = $em->getRepository('XMBForumBundle:Thread')
                        ->find($thread['threadid']);
                    
                    $replies = $threadentity->getReplies() + 1;
                    
                    $threadentity->setLastactivity(time());
                    $threadentity->setReplies($replies);
                    $em->persist($threadentity);
                    $em->flush();                                                               
                    
                    return $this->redirect($this->generateUrl('_thread', array(
                        'slug'  => $thread['slug']
                    )));
                } else {
                    if ($thread['status'] == 0) {
                        $form->addError(new FormError('You cannot reply to this thread as it is currently locked!'));
                    }
                }
            }                        
            
            return $this->render('XMBForumBundle:Thread:view.html.twig', array(
                'thread'    => $thread,
                'replies'   => $replies,
                'form'      => $form->createView()
            ));
        }
    }
    
    public function toggleThreadStatusAction($slug, $action, Request $request) {
        if ($request->isXmlHttpRequest()) {           
            // Find the thread
            $em = $this->getDoctrine()->getEntityManager();
            
            $thread = $em->getRepository('XMBForumBundle:Thread')
                ->find(intval($request->get('threadid')));
            
            $error      = '';
            $newstatus  = 0;
            
            if (!$thread) {
                $error = 'The thread you are trying to open/close could not be found.';
            } else {               
                if ($this->get('security.context')->isGranted('ROLE_ADMIN')) {
                    
                    if ($thread->getStatus() == 1) {
                        $thread->setStatus(0); // Closed
                    } else {
                        $thread->setStatus(1); // Open
                    }
                    $newstatus = $thread->getStatus();
                
                    // Update status
                    $em->persist($thread);
                    $em->flush();  
                } else {
                    $error = 'You do not have permission to change the status of this thread.';  
                } 
            }                       
            
            $response = new Response(json_encode(array(
                'action'    => 'thread_status_toggled',
                'status'    => $newstatus,
                'error'     => $error
            )));
            
            $response->headers->set('Content-Type', 'application/json');
            
            return $response;
        }
    }
    
    public function deleteAction($slug, $action, Request $request) {    
        $em = $this->getDoctrine()->getEntityManager();
        
        // Current user
        $user = $this->get('security.context')->getToken()->getUser();
        
        if ($user == 'anon.') {
            return $this->forward('XMBForumBundle:Error:index', array(
                'error' => 'You must be logged in in order to delete threads!'
            )); 
        }
        
        // Find thread
        $thread = $em->getRepository('XMBForumBundle:Thread')
            ->findBy(array(
                'slug'  => $slug
            ));
        
        if (is_array($thread) && count($thread) > 0) {
            $thread = $thread[0];
        }
            
        // Thread doesn't exist
        if (!$thread || count($thread) == 0) {
            return $this->forward('XMBForumBundle:Error:index', array(
                'error' => 'The thread you are attempting to delete does not exist or has already been deleted.'
            ));
        }
        
        // Doesn't have access to delete
        if ($this->get('security.context')->isGranted('ROLE_ADMIN') === false || $thread->getUserid() != $user->getId()) {
            return $this->forward('XMBForumBundle:Error:index', array(
                'error' => 'You do not have the required permissions to delete this thread!'
            ));
        }
        
        // Delete posts
        $em->createQuery()
            ->delete()
            ->from('XMBForumBundle:Post p')
            ->where('p.threadid = ?', $thread->getId())
            ->execute();
        
        // Delete the thread
        $em->remove($thread);
        $em->flush();
        
        return $this->forward('XMBForumBundle:Home:index', array(
            'forum' => 0
        ));
    }
    
    public function newAction($forum=0, $postid=0, Request $request = null) {
        $thread = new ThreadEntity();
        
        $form = $this->createForm(new ThreadFormType(), $thread, array(
            'forumid'   => $forum
        ));
        
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            
            if ($form->isValid()) {
                $user = $this->get('security.context')->getToken()->getUser();
                
                // Set necessary thread values
                $thread->setUserid($user->getId());
                $thread->setForumid($thread->getForumid()->getId());
                
                // Persist thread to db
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($thread);
                $em->flush();   
                
                // Fetch and set values for the Post entity
                $post = $thread->getPost();
                $post->setThreadid($thread->getId());
                $post->setUserid($user->getId());
                                
                $em->persist($thread->getPost());      
                $em->flush();                                                           
                
                return $this->redirect($this->generateUrl('_thread', array(
                    'slug'  => $thread->getSlug()
                )));
            }
        }
        
        return $this->render('XMBForumBundle:Thread:new.html.twig', array(
            'forumid'   => $forum,
            'form'      => $form->createView()
        ));
    }
    
    public function editAction($postid, Request $request) {
        $postid = intval($postid);
        
        $user = $this->get('security.context')->getToken()->getUser();
        
        if ($user == 'anon.') {
            return $this->forward('XMBForumBundle:Error:index', array(
                'error' => 'You must be logged in to edit posts!'
            ));
        }
        
        // Find the post
        $post = $this->getDoctrine()->getEntityManager()
            ->getRepository('XMBForumBundle:Post')
            ->find($postid);
            
        if (!$post) {
            return $this->forward('XMBForumBundle:Error:index', array(
                'error' => 'The post you are trying to edit does not exist!'
            ));
        }
        
        // Check permissions
        if ($this->get('security.context')->isGranted('ROLE_ADMIN') === false && $user->getId() != $post->getId()) {
            return $this->forward('XMBForumBundle:Error:index', array(
                'error' => 'You do not have permission to edit this post!'
            ));
        }
        
        $form = $this->createForm(new PostFormType(), $post);
        
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            
            if ($form->isValid()) {
                // Persist thread to db
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($post);
                $em->flush();   
                
                // Get thread information for forwarding.
                $thread = $em->getRepository('XMBForumBundle:Thread')
                    ->find($post->getThreadid());
                
                if (!$thread) {
                    return $this->redirect($this->generateUrl('_home'));
                }
                                
                return $this->redirect($this->generateUrl('_thread', array(
                    'slug'  => $thread->getSlug()
                )));
            }
        }
        
        return $this->render('XMBForumBundle:Thread:editpost.html.twig', array(
            'post'      => $post,
            'form'      => $form->createView()
        ));
    }
}
