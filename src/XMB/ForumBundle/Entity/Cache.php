<?php

namespace XMB\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * XMB\ForumBundle\Entity\Cache
 */
class Cache
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var text $data
     */
    private $data;

    /**
     * @var smallint $serialize
     */
    private $serialize;


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
     * Set data
     *
     * @param text $data
     */
    public function setData($data)
    {
        if ($this->getSerialize() == 1) {
            $this->data = serialize($data);
        } else {
            $this->data = $data;
        }
    }

    /**
     * Get data
     *
     * @return text 
     */
    public function getData()
    {
        if ($this->getSerialize() == 1) {
            return unserialize($this->data);
        } else {
            return $this->data;
        }
    }

    /**
     * Set serialize
     *
     * @param smallint $serialize
     */
    public function setSerialize($serialize)
    {
        $this->serialize = $serialize;
    }

    /**
     * Get serialize
     *
     * @return smallint 
     */
    public function getSerialize()
    {
        return $this->serialize;
    }
}