<?php

namespace XMB\ForumBundle\Listeners;

use Doctrine\ORM\Event\LifecycleEventArgs;
use XMB\ForumBundle\Entity\Cache;
use XMB\ForumBundle\Entity\Users;

class UserCreationListener {
    public function postPersist(LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        $em     = $args->getEntityManager();
        
        // Are we working with the Users entity?
        if ($entity instanceof Users) {
            $cache = $em->getRepository('XMBForumBundle:Cache')->findBy(array(
                'name'  => 'usercount'
            ));
            
            if (is_array($cache) && count($cache) > 0) {
                $cache = $cache[0];
            }
            
            if (!$cache) { // Create a new entry
                $cache = new Cache();
                $cache->setName('usercount');
                $cache->setData(1);
                $cache->setSerialize(0);                            
            } else {
                $userCount = $cache->getData() + 1;
                
                $cache->setData($userCount);
            }
            
            // Update/add count
            $em->persist($cache);
            $em->flush();
        }        
    }
}

?>