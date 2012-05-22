<?php

namespace XMB\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use XMB\ForumBundle\Form\Type\ThreadFormType;
use XMB\ForumBundle\Entity\Thread AS ThreadEntity;
use XMB\ForumBundle\Model\Thread;


class ThreadController extends Controller
{
    
    public function indexAction($slug, Request $request)
    {
        $thread = new Thread($this->get('database_connection'));
        $thread = $thread->fetchThread($slug);
        
        if ($request->isXmlHttpRequest()) {
            $response = new Response(json_encode($thread));
            
            $response->headers->set('Content-Type', 'application/json');
            
            return $response;
        } else {
            return $this->render('XMBForumBundle:Thread:view.html.twig', array(
                'thread'    => $thread
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
                
                return $this->redirect($this->generateUrl('_home'));
            }
        }
        
        return $this->render('XMBForumBundle:Thread:new.html.twig', array(
            'forumid'   => $forum,
            'form'      => $form->createView()
        ));
    }
    
    public function topAction() {
        
    }
}
