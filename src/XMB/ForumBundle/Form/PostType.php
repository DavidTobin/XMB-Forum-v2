<?php

namespace XMB\ForumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PostType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('threadid')
            ->add('userid')
            ->add('message')
        ;
    }

    public function getName()
    {
        return 'xmb_forumbundle_posttype';
    }
}
