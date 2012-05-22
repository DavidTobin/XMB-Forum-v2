<?php

namespace XMB\ForumBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use XMB\ForumBundle\Entity\Post;

class ThreadReplyFormType extends AbstractType {
    
    public function buildForm(FormBuilder $builder, array $options) {        
        $builder->add('message', null, array(
            'label' => 'Message',
            'attr'  => array(
                'class'         => 'tinymce',
                'data-theme'    => 'bbcode'
            )
        ));        
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'XMB\ForumBundle\Entity\Post'
        );
    }

    public function getName()
    {
        return 'post';
    }
    
}