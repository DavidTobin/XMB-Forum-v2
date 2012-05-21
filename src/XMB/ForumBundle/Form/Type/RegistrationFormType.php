<?php

namespace XMB\ForumBundle\Form\Type;

use Symfony\Component\Form\FormBuilder;
use FOS\UserBundle\Form\Type\RegistrationFormType AS BaseType;

class RegistrationFormType extends BaseType {
    
    public function buildForm(FormBuilder $builder, array $options) {
        parent::buildForm($builder, $options);
        
        $builder->remove('username');
        $builder->remove('email'); // Remove FOS email field
        $builder->remove('plainPassword');
        $builder->add('username', null, array('label' => 'Username'));
        $builder->add('email', 'email', array('label' => 'Email Address'));            
        $builder->add('plainPassword', 'repeated', array('first_name' => 'Password', 'second_name' => 'Confirm Password'));
    }
    
    public function getName() {
        return 'forum_user_registration';
    }
    
}