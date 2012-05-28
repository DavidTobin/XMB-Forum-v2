<?php

namespace XMB\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ErrorController extends Controller
{
    public function indexAction($error="Unknown error.") {        
        return $this->render('XMBForumBundle::error.html.twig', array(
            'error'     => $error
        ));
    }
}