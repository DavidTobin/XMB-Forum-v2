<?php

namespace XMB\ForumBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class Users extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    
    /**
     * @ORM\ManyToOne(targetEntity="Thread", inversedBy="user")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    protected $thread;    
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @var text $signature
     */
    private $signature;


    /**
     * Set signature
     *
     * @param text $signature
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;
    }

    /**
     * Get signature
     *
     * @return text 
     */
    public function getSignature()
    {
        return $this->signature;
    }
    /**
     * @var integer $userid
     */
    private $userid;


    /**
     * Get userid
     *
     * @return integer 
     */
    public function getUserid()
    {
        return $this->userid;
    }
}