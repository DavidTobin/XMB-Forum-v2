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
    
    public function newAction($forumid=0) {
        $thread = new ThreadEntity();
        
        $form = $this->createForm(new ThreadFormType(), $thread);
        
        return $this->render('XMBForumBundle:Thread:new.html.twig', array(
            'forumid'   => $forumid,
            'form'      => $form->createView()
        ));
    }
    
    public function topAction() {
        
    }
}
