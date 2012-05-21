<?php

namespace Todo\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Todo\Bundle\Entity\Beta;
use Todo\Bundle\Form\Type\BetaFormType;
use Symfony\Component\HttpFoundation\Request;

class BetaController extends Controller {
    
    public function indexAction() {
        return $this->render('TodoBundle:Default:index.html.twig');
    }
    
    public function routeAction($action) {
        switch($action) {
            case 'apply':
                return $this->forward('TodoBundle:Beta:apply');
                break;
                
            default:
                return $this->forward('TodoBundle:Default:index');
        }
    }
    
    public function applyAction(Request $request) {
        $beta = new Beta();
        
        $form = $this->createForm(new BetaFormType(), $beta);
        
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            
            if ($form->isValid()) {
                $beta->setDateline(time());
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($beta);
                $em->flush();
                
                return $this->render('TodoBundle:Beta:success.html.twig');
            }
        } else {
            return $this->render('TodoBundle:Default:index.html.twig');   
        }
    }
}