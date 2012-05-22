<?php

namespace XMB\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * XMB\ForumBundle\Entity\Thread
 */
class Thread
{
    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $slug
     */
    private $slug;

    /**
     * @var integer $userid
     */
    private $userid;

    /**
     * @var integer $dateline
     */
    private $dateline;

    /**
     * @var integer $rating
     */
    private $rating;

    /**
     * @var smallint $status
     */
    private $status;

    /**
     * @var integer $id
     */
    private $id;
    
    /**
     * @ORM\OneToMany(targetEntity="Users", mappedBy="userid")
     */
     protected $user;
     
    protected $post;

    
    public function __construct() {
        $this->user = new ArrayCollection();
    }
    
    public function getPost() {
        return $this->post;
    }
    
    public function setPost(Post $post = null) {
        $this->post = $post;
    }
    
    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
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
     * Set dateline
     *
     * @param integer $dateline
     */
    public function setDateline($dateline)
    {
        $this->dateline = $dateline;
    }

    /**
     * Get dateline
     *
     * @return integer 
     */
    public function getDateline()
    {
        return $this->dateline;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * Get rating
     *
     * @return integer 
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set status
     *
     * @param smallint $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return smallint 
     */
    public function getStatus()
    {
        return $this->status;
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
     * @var integer $forumid
     */
    private $forumid;


    /**
     * Set forumid
     *
     * @param integer $forumid
     */
    public function setForumid($forumid)
    {
        $this->forumid = $forumid;
    }

    /**
     * Get forumid
     *
     * @return integer 
     */
    public function getForumid()
    {
        return $this->forumid;
    }
}