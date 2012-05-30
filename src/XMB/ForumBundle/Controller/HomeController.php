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
        // Lets set some variables
        $db         = $this->get('database_connection');                                          
        $user       = $this->get('security.context')->getToken()->getUser();
        $where      = '';        
        $forumname  = 'Latest Threads';
        $forumid    = 0;
                
        if ($forum) {
            // Find forum by slug
            $getforum = $this->getDoctrine()->getEntityManager()
                ->getRepository('XMBForumBundle:Forum')
                ->findBy(array(
                    'slug'  => $forum
                ));
            
            if (count($getforum) > 0) {  
                $forumname = $getforum[0]->getForumname();
                $forumid   = $getforum[0]->getId();
                
                // If not latest threads, search only for threads within selected forum.
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
        // Add an error if no threads are found.
        if (!$threads) {
            if ($forumid == 0) {
                $error = "Welcome to your new forum! Create a new thread using the actions menu to remove this message!";
            } else {
                $error = "This forum doesn't have any threads! Go ahead and create one using the actions menu!";
            }
        }
        
        // Statistics
        
        
        if ($request->isXmlHttpRequest()) { // Return JSON if from ajax request
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
                'action'    => 'update_thread_list' // Name of JS action to call within XMB.js
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
