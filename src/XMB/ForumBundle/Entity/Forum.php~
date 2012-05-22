<?php

namespace XMB\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * XMB\ForumBundle\Entity\Forum
 */
class Forum
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $forumname
     */
    private $forumname;

    /**
     * @var integer $displayorder
     */
    private $displayorder;


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
     * Set forumname
     *
     * @param string $forumname
     */
    public function setForumname($forumname)
    {
        $this->forumname = $forumname;
    }

    /**
     * Get forumname
     *
     * @return string 
     */
    public function getForumname()
    {
        return $this->forumname;
    }

    /**
     * Set displayorder
     *
     * @param integer $displayorder
     */
    public function setDisplayorder($displayorder)
    {
        $this->displayorder = $displayorder;
    }

    /**
     * Get displayorder
     *
     * @return integer 
     */
    public function getDisplayorder()
    {
        return $this->displayorder;
    }
    /**
     * @var string $slug
     */
    private $slug;


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
     * @var text $description
     */
    private $description;


    /**
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    public function __toString() {
        return $this->getForumname();
    }
}