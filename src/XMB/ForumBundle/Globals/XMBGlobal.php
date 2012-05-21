<?php

namespace XMB\ForumBundle\Globals;

use Twig_Extension;
use Symfony\Bundle\DoctrineBundle\Registry;
use XMB\ForumBundle\Model\Notifications;

class XMBGlobal extends Twig_Extension {
    protected $doctrine;

    public function __construct(Registry $doctrine, $container) {
        $this->doctrine = $doctrine;
        $this->container = $container;       
    }
    
    public function getGlobals() {
        $notifications = new Notifications($this->doctrine, $this->container);
        
        return array(
            'notification_count'    => $notifications->getNotificationsCount(),
            'notifications'         => $notifications->fetchUserNotifications()
        );
    }
    
    public function getName() {
        return 'xmb_forum_global';
    }
}
?>