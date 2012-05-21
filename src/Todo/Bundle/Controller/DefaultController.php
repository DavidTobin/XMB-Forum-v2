<?php

namespace Todo\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Todo\Bundle\Form\Type\BetaFormType;
use Todo\Bundle\Entity\Beta AS Beta;

class DefaultController extends Controller
{
    
    public function indexAction()
    {
        $user = $this->get('security.context');
        
        $form = $this->createForm(new BetaFormType(), new Beta());
        
        if ($user->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->render('TodoBundle:Default:home.html.twig');
        } else {
            return $this->render('TodoBundle:Default:index.html.twig', array(
                'form'  => $form->createView()
            ));
        }
    }
}
