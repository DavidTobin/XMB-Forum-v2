<?php

namespace Todo\Bundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class BetaFormType extends AbstractType {
    
    public function buildForm(FormBuilder $builder, array $options) {
        $builder->add('email', 'email', array(
            'label'         => 'Email Address'
        ));
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Todo\Bundle\Entity\Beta',
        );
    }
    
    public function getName() {
        return 'todo_beta';
    }
    
}