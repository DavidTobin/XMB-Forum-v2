<?php

namespace XMB\ForumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('email')
            ->add('enabled')
            ->add('password', 'password')
            ->add('signature')
        ;
    }

    public function getName()
    {
        return 'xmb_forumbundle_userstype';
    }
}
