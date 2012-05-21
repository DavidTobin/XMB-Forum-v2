<?php

namespace XMB\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfileController extends Controller {
    
    public function indexAction($username="") {
        if (empty($username)) {
            $user       = $this->get('security.context')->getToken()->getUser()->getUser();
            $username   = $user->getUsername();
        } else {
            $user       = $this->getDoctrine()->getEntityManager()->getRepository('XMBForumBundle:Users')->findBy(array(
                'username'  => $username
            ));
        }
        
        return $this->render('XMBForumBundle:Profile:view.html.twig', array(
            'user'  => $user[0]
        ));
    }
    
}