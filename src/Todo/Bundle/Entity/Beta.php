<?php

namespace Todo\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Todo\Bundle\Entity\Beta
 */
class Beta
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $email
     */
    private $email;

    /**
     * @var time $dateline
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
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set dateline
     *
     * @param time $dateline
     */
    public function setDateline($dateline)
    {
        $this->dateline = $dateline;
    }

    /**
     * Get dateline
     *
     * @return time 
     */
    public function getDateline()
    {
        return $this->dateline;
    }
}