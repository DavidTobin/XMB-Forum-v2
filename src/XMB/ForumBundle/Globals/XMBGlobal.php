<?php

namespace XMB\ForumBundle\Globals;

use Twig_Extension;
use Symfony\Bundle\DoctrineBundle\Registry;
use XMB\ForumBundle\Model\Notifications;
use XMB\ForumBundle\Entity\Online;

class XMBGlobal extends Twig_Extension {
    protected $doctrine;
    
    protected $online;

    public function __construct(Registry $doctrine, $container) {
        $this->doctrine = $doctrine;
        $this->container = $container;  
        
        
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
    }
    
    public function load() {
        var_dump($this->container->get('security.context'));
    }
    
    public function getGlobals() {
        $notifications = new Notifications($this->doctrine, $this->container);
        
        $lastonlineid = 0;
        if (is_object(end($this->online))) {
            $lastonlineid = end($this->online)->getUserid();
        }
        
        return array(
            'notification_count'    => $notifications->getNotificationsCount(),
            'notifications'         => $notifications->fetchUserNotifications(),
            'online'                => $this->online,
            'online_count'          => count($this->online),
<<<<<<< HEAD
            'lastonlineid'          => $lastonlineid
=======
            'lastonlineid'          => end($this->online)->getUserid()
>>>>>>> 6e8e6d90848027e339116c6d92a149ff98e5552e
        );
    }
    
    public function getName() {
        return 'xmb_forum_global';
    }
}
?>