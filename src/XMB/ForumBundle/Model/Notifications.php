<?php

namespace XMB\ForumBundle\Model;

class Notifications {
    
    private $doctrine;
    private $container;
    
    private $notifications = null;
    
    public function __construct($doctrine, $container) {
        $this->doctrine     = $doctrine;
        $this->container    = $container; 
        
        $this->user = $this->container->get('security.context')->getToken()->getUser();        
    }
    
    public function getNotificationsCount() {
        if ($this->notifications === null) {
            $this->fetchUserNotifications();
        }
        
        return count($this->notifications);
    }
    
    public function fetchUserNotifications() {
        if (count($this->notifications)) {
            return $this->notifications;
        }
        
        if ($this->user == 'anon.') {
            return array();
        }
        
        $this->notifications = $this->doctrine->getEntityManager()
            ->getRepository('XMBForumBundle:Notification')
            ->findBy(array(
                'userid'    => $this->user->getId()
        ));
        
        foreach ($this->notifications AS $index => $notification) {
            $name = $this->getNotificationByType($notification->getType(), $notification->getCount());
            
            $this->notifications[$index]->setType($name);
        }
        
        return $this->notifications;
    }
    
    public function getNotificationByType($type, $count=0) {
        switch ($type) {
            case 'new_im':
                return $count . ' new instant messages';                
                break;
            
            default:
                return 'Unknown Notification';
                break;
        }
    }
    
}

?>