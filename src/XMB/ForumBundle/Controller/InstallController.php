<?php

namespace XMB\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use XMB\ForumBundle\Entity\Forum;
use XMB\ForumBundle\Entity\Users;

class InstallController extends Controller
{        
    public function indexAction(Request $request) {
        if ($this->container->getParameter('installation')) {
            return $this->forward('XMBForumBundle:Error:index', array(
                'error' => 'XMB has already been installed!'
            ));
        } 
        
        if ($request->getMethod() == 'POST') {
            // Get the kernel
            $kernel = $this->get('kernel');
            
            // Get console parser
            $application = new \Symfony\Bundle\FrameworkBundle\Console\Application($kernel);
            $application->setAutoExit(false);
            
            // Create the database
            $options = array(
                'command' => 'doctrine:database:create'
            );
            
            $application->run(new \Symfony\Component\Console\Input\ArrayInput($options));
            
            // Update the schema 
            $options = array(
                'command' => 'doctrine:schema:update',
                '--force' => true
            );
            
            // Run the installer
            $application->run(new \Symfony\Component\Console\Input\ArrayInput($options));
            
            // Create the sessions table
            $this->get('database_connection')->executeQuery("
                CREATE TABLE session ( session_id varchar(255) NOT NULL, session_value text NOT NULL, session_time int(11) NOT NULL, PRIMARY KEY (session_id) ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ");
            
            // Post installation items
            
            return $this->postInstall();
        }
        
        return $this->render('XMBForumBundle:Install:index.html.twig');
    }
    
    private function postInstall() {
        $em = $this->getDoctrine()->getEntityManager();                
        
        // Create the default forum
        $forum = new Forum();        
        $forum->setForumname('Default Forum');
        $forum->setDescription('The default forum created at installation!');
        $forum->setSlug('default-forum'); 
        $forum->setDisplayorder(0);
        
        $em->persist($forum);
        $em->flush();       
        
        // Create the default user
        $manipulator = $this->get('fos_user.util.user_manipulator');
        $manipulator->create('Admin', 'admin', 'admin@website.com', true, true);
        
        return $this->render('XMBForumBundle:Install:complete.html.twig');      
    }
}
