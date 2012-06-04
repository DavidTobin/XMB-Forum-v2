<?php

namespace XMB\ForumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ForumType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('forumname', null, array('label' => 'Forum Name'))
            ->add('slug')
            ->add('description')
            ->add('displayorder', null, array('label' => 'Display Order'))
        ;
    }

    public function getName()
    {
        return 'xmb_forumbundle_forumtype';
    }
}
