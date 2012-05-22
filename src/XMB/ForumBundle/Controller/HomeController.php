<?php

namespace XMB\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use XMB\ForumBundle\Model\Thread AS ThreadModel;
use XMB\ForumBundle\Entity\Thread;
use XMB\ForumBundle\Entity\Users;


class HomeController extends Controller
{
    
    public function indexAction($forum, Request $request)
    {      
        $db = $this->get('database_connection');          
                
        $where = '';
        
        $forumname  = 'Latest Threads';
        $forumid    = 0;
        if ($forum) {
            $getforum = $this->getDoctrine()->getEntityManager()
                ->getRepository('XMBForumBundle:Forum')
                ->findBy(array(
                    'slug'  => $forum
                ));
            
            if (count($getforum) > 0) {  
                $forumname = $getforum[0]->getForumname();
                $forumid   = $getforum[0]->getId();
                
                $where .= 'WHERE t.forumid = "' . $getforum[0]->getId() . '"';
            }
        }
        
        // Generate follow url for new threads
        $followurl = $this->generateUrl('_thread_new', array(
           'forum'  => $forumid 
        ));
        
        $threads = new ThreadModel($db);
        $threads = $threads->fetchAll($where);
        
        $error = "";
        if (!$threads) {
            $error = "Welcome to your new forum!";
        }
        
        if ($request->isXmlHttpRequest()) {
            foreach ($threads AS $index => $thread) {
                $threads[$index] = $this->render('XMBForumBundle:Home:thread.html.twig', array(
                    'thread'    => $thread
                ))->getContent();
            }
            
            $response = new Response(json_encode(array(
                'threads'   => $threads,
                'forumname' => $forumname,
                'followurl' => $followurl,
                'error'     => $error,
                'action'    => 'update_thread_list'
            )));   
            
            $response->headers->set('Content-Type', 'application/json');            
            
            return $response;
        } else {
            $forums = $this->getDoctrine()->getEntityManager()
                ->getRepository('XMBForumBundle:Forum')
                ->findAll();
            
            return $this->render('XMBForumBundle:Home:index.html.twig', array(
                'threads'   => $threads,
                'forumname' => $forumname,
                'followurl' => $followurl,
                'forums'    => $forums,
                'error'     => $error
            ));
        }
    }
}
