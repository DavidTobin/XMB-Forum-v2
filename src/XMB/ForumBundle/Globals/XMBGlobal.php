<?php

namespace XMB\ForumBundle\Globals;

use Twig_Extension;
use Symfony\Bundle\DoctrineBundle\Registry;
use XMB\ForumBundle\Model\Notifications;
use XMB\ForumBundle\Entity\Online;

class XMBGlobal extends Twig_Extension {
    protected $doctrine;
    protected $container;
    protected $installed    = 1;
    protected $online       = array();
    protected $onlineCalled = false;

    public function __construct(Registry $doctrine, $container) {
        $this->doctrine     = $doctrine;
        $this->container    = $container;  
        $this->installed    = intval($container->getParameter('installation')); 
    }
    
    private function checkOnline() {
        if ($this->onlineCalled == true) {
            return; // Prevent duplicate runs of the function
        }
        
        if ($this->installed == 0 || $this->installed == 2) {
            return;
        }
        
        // Who's Online
        $token = $this->container->get('security.context')->getToken();
        
        if (is_object($token)) {
            $user = $token->getUser();
            
            if ($user != 'anon.') {                                
                $em = $this->doctrine->getEntityManager();
                
                $online = $em->getRepository('XMBForumBundle:Online')->findBy(array('userid' => $user->getId()));
                
                if (!$online) {
                    $online = new Online();
                    $online->setUsername($user->getUsername());
                    $online->setUserid($user->getId());
                    $online->setLastactive(time());
                    
                    $em->persist($online);
                } else {
                    $online[0]->setLastactive(time());
                }
                                
                $em->flush();
           }
           
           // Remove inactive
           $lastactive = time() - (15 * 60); // 15 minutes
           
           $this->container->get('database_connection')->query("
                DELETE FROM online
                WHERE lastactive < $lastactive
           ");
           
           $this->online = $this->doctrine->getEntityManager()
                ->getRepository('XMBForumBundle:Online')
                ->findAll();                        
        }
        
        // lets specify that this has already been called to prevent it being called again
        $this->onlineCalled = true;     
    }
    
    public function getGlobals() { 
        $this->checkOnline();
        // Get canonical url
        $route = $this->container->get('request')->get('_route');
        
        if ($this->installed == 0 || $this->installed == 2) { // Check if forum is installed
            return array();
        }
        
        $lastonlineid = 0;
        if (is_object(end($this->online))) {
            $lastonlineid = end($this->online)->getUserid();
        }
        
        return array(
            'online'                => $this->online,
            'online_count'          => count($this->online),
            'lastonlineid'          => $lastonlineid,
            'canonical'             => $route
        );
    }
    
    public function getName() {
        return 'xmb_forum_global';
    }
}
?>