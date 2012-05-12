<?php

namespace Todo\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('TodoBundle:Default:index.html.twig');
    }
}
