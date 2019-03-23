<?php
// src/App/Form/RegistrationType.php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;



use Symfony\Component\Form\Extension\Core\Type\DateType;


class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('phone');
        $builder->add('surname');
        $builder->add('middlename');

        $builder->add('dateofbirth', DateType::class, [
            'widget' => 'single_text',
//            'format' => 'yyyy-MM-dd',
//            'placeholder' => 'efef'
        ]);

    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getPhone()
    {
        return $this->getBlockPrefix();
    }
}
