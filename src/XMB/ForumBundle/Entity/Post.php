<?php

namespace XMB\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * XMB\ForumBundle\Entity\Post
 */
class Post
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var integer $threadid
     */
    private $threadid;

    /**
     * @var integer $userid
     */
    private $userid;

    /**
     * @var text $message
     */
    private $message;
    
    public function __construct() {
        $this->setParentid(0);
    }

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
     * Set threadid
     *
     * @param integer $threadid
     */
    public function setThreadid($threadid)
    {
        $this->threadid = $threadid;
    }

    /**
     * Get threadid
     *
     * @return integer 
     */
    public function getThreadid()
    {
        return $this->threadid;
    }

    /**
     * Set userid
     *
     * @param integer $userid
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;
    }

    /**
     * Get userid
     *
     * @return integer 
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set message
     *
     * @param text $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * Get message
     *
     * @return text 
     */
    public function getMessage()
    {
        return $this->message;
    }
    /**
     * @var integer $parentid
     */
    private $parentid;


    /**
     * Set parentid
     *
     * @param integer $parentid
     */
    public function setParentid($parentid)
    {
        $this->parentid = $parentid;
    }

    /**
     * Get parentid
     *
     * @return integer 
     */
    public function getParentid()
    {
        return $this->parentid;
    }
}