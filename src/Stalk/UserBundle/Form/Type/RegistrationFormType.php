<?php

namespace Stalk\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->remove('username')
            ->add('firstname', null, array('label' => 'form.firstname', 'translation_domain' => 'FOSUserBundle'))
            ->add('surname', null, array('label' => 'form.surname', 'translation_domain' => 'FOSUserBundle'))
            ->add('phone', null, array('label' => 'form.phone', 'translation_domain' => 'FOSUserBundle'))
            ->add('company', null, array('label' => 'form.company', 'translation_domain' => 'FOSUserBundle'))
            ->add('site', null, array('label' => 'form.site', 'translation_domain' => 'FOSUserBundle'))
        ;
    }

    public function getName()
    {
        return 'stalk_user_registration';
    }
}