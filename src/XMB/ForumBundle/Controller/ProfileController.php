<?php

namespace XMB\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfileController extends Controller {
    
    public function indexAction($username="") {
        // If no user specified, use our own username.
        if (empty($username)) {
            $user       = $this->get('security.context')->getToken()->getUser();
            
            if (!is_object($user)) { // Forward guest to registration
                return $this->redirect($this->generateUrl('fos_user_registration_register'));    
            }
            
            $username   = $user->getUsername();
        } else {
            $user       = $this->getDoctrine()->getEntityManager()->getRepository('XMBForumBundle:Users')->findBy(array(
                'username'  => $username
            ));
        }
        
        if (is_array($user)) { // Else block will return an array
            if (count($user) > 0) {
                $user = $user[0];
            } else {
                return $this->forward('XMBForumBundle:Error:index', array(
                    'error'     => 'The user you are looking for does not exist!'
                ));
            }
        }
        
        return $this->render('XMBForumBundle:Profile:view.html.twig', array(
            'user'  => $user
        ));
    }
    
}