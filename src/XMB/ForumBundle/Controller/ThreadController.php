<?php

namespace XMB\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use XMB\ForumBundle\Form\Type\ThreadFormType;
use XMB\ForumBundle\Entity\Thread AS ThreadEntity;
use XMB\ForumBundle\Form\Type\ThreadReplyFormType;
use XMB\ForumBundle\Entity\Post;
use XMB\ForumBundle\Model\Thread;


class ThreadController extends Controller
{
    
    public function indexAction($slug, Request $request)
    {
        $threadm    = new Thread($this->get('database_connection'));
        $thread     = $threadm->fetchThread($slug); 
        $replies    = $threadm->fetchReplies($thread);           
        
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
                
                if ($form->isValid()) {
                    // Get entity manager
                    $em = $this->getDoctrine()->getEntityManager();
                    
                    $user = $this->get('security.context')->getToken()->getUser();
                    
                    // Set necessary post values
                    $post->setUserid($user->getId());
                    $post->setThreadid($thread['threadid']);
                    $post->setParentid($thread['id']);
                                    
                    $em->persist($post);      
                    $em->flush();
                    
                    // Update thread last activity
                    $threadentity = $em->getRepository('XMBForumBundle:Thread')
                        ->find($thread['threadid']);
                    
                    $threadentity->setLastactivity(time());
                    $em->persist($threadentity);
                    $em->flush();                                                               
                    
                    return $this->redirect($this->generateUrl('_thread', array(
                        'slug'  => $thread['slug']
                    )));
                }
            }
            
            return $this->render('XMBForumBundle:Thread:view.html.twig', array(
                'thread'    => $thread,
                'replies'   => $replies,
                'form'      => $form->createView()
            ));
        }
    }
    
    public function newAction($forum=0, Request $request = null) {
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
}
