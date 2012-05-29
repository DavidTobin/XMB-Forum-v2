<?php

namespace XMB\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use SamJ\DoctrineSluggableBundle\SluggableInterface;

/**
 * XMB\ForumBundle\Entity\Thread
 */
class Thread implements SluggableInterface
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
        
        if ($this->getId() == 0) {
            $this->setDateline(time());
            $this->setLastactivity(time());
            $this->setRating(0);
            $this->setStatus(1);
            $this->setReplies(0);
        }
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
        if (!empty($this->slug)) return false;
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
    
    public function getSlugFields() {
        return array($this->getName());
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
    public function setDateline($dateline=0)
    {
        if ($dateline === 0) {
            $dateline = time();
        }
        
        $this->dateline = $dateline;
    }

    /**
     * Get dateline
     *
     * @return integer 
     */
    public function getDateline()
    {
        if ($this->dateline == null) {
            $this->dateline = time();    
        }
        
        return $this->dateline;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     */
    public function setRating($rating=0)
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
        if (!$this->rating) {
            $this->rating = 0;    
        }
        
        return $this->rating;
    }

    /**
     * Set status
     *
     * @param smallint $status
     */
    public function setStatus($status=1)
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
    /**
     * @var integer $lastactivity
     */
    private $lastactivity;


    /**
     * Set lastactivity
     *
     * @param integer $lastactivity
     */
    public function setLastactivity($lastactivity)
    {
        $this->lastactivity = $lastactivity;
    }

    /**
     * Get lastactivity
     *
     * @return integer 
     */
    public function getLastactivity()
    {
        return $this->lastactivity;
    }
    /**
     * @var integer $replies
     */
    private $replies;

    /**
     * @var integer $threadid
     */
    private $threadid;


    /**
     * Set replies
     *
     * @param integer $replies
     */
    public function setReplies($replies)
    {
        $this->replies = $replies;
    }

    /**
     * Get replies
     *
     * @return integer 
     */
    public function getReplies()
    {
        return $this->replies;
    }
}