<?php

namespace XMB\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * XMB\ForumBundle\Entity\Message
 */
class Message
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var integer $fromuserid
     */
    private $fromuserid;

    /**
     * @var integer $touserid
     */
    private $touserid;

    /**
     * @var text $content
     */
    private $content;

    /**
     * @var integer $dateline
     */
    private $dateline;


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
     * Set fromuserid
     *
     * @param integer $fromuserid
     */
    public function setFromuserid($fromuserid)
    {
        $this->fromuserid = $fromuserid;
    }

    /**
     * Get fromuserid
     *
     * @return integer 
     */
    public function getFromuserid()
    {
        return $this->fromuserid;
    }

    /**
     * Set touserid
     *
     * @param integer $touserid
     */
    public function setTouserid($touserid)
    {
        $this->touserid = $touserid;
    }

    /**
     * Get touserid
     *
     * @return integer 
     */
    public function getTouserid()
    {
        return $this->touserid;
    }

    /**
     * Set content
     *
     * @param text $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Get content
     *
     * @return text 
     */
    public function getContent()
    {
        return $this->content;
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
}