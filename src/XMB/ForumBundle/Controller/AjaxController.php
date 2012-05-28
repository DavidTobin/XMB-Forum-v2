<?php

namespace XMB\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use XMB\ForumBundle\Entity\Thread;

class AjaxController extends Controller
{
    public function indexAction($action, Request $request) {
        // Convert our action variable to the function name.
        $action .= 'Action';
        
        if (method_exists($this, $action)) {
            return $this->$action($request);
        } else {
            return new Response('Invalid action specified!', 404);
        }
    }
     
    public function update_thread_ratingAction(Request $request) {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getEntityManager();
            
            $rating     = intval($request->get('rating'));
            $threadid   = intval($request->get('thread'));
            
            // Find the thread
            $thread = $em->getRepository('XMBForumBundle:Thread')->find($threadid);
                        
            $newRating = $rating;
            if ($thread) {
                $newRating = $thread->getRating() + $rating;
                
                $thread->setRating($newRating);                                
                
                $em->flush(); 
            }
            
            $response = new Response(json_encode(array(
                'rating'    => $newRating,
                'action'    => 'thread_rating_updated'
            )));
            
            $response->headers->set('Content-Type', 'application/json');
            
            return $response;
        } else {
            return new Response("", 400);
        }
    }
}