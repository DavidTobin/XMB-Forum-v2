<?php

namespace XMB\ForumBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use XMB\ForumBundle\Entity\Thread;
use XMB\ForumBundle\Form\Type\PostFormType;

class ThreadFormType extends AbstractType {
    
    public function buildForm(FormBuilder $builder, array $options) {
        $builder->add('name', null, array('label' => 'Title'));
        $builder->add('post', new PostFormType());
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'XMB\ForumBundle\Entity\Thread',
        );
    }

    public function getName()
    {
        return 'thread';
    }
    
}