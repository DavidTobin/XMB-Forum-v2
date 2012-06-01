<?php

namespace XMB\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller {
    
    public function indexAction() {
        return $this->render('XMBForumBundle:Admin:index.html.twig');
    }
    
}

?>