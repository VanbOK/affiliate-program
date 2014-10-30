<?php

namespace Stalk\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

class ProfileFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle', 'disabled' => true))
            ->add('firstname', null, array('label' => 'form.firstname', 'translation_domain' => 'FOSUserBundle'))
            ->add('surname', null, array('label' => 'form.surname', 'translation_domain' => 'FOSUserBundle'))
            ->add('phone', null, array('label' => 'form.phone', 'translation_domain' => 'FOSUserBundle'))
            ->add('company', null, array('label' => 'form.company', 'translation_domain' => 'FOSUserBundle'))
            ->add('site', null, array('label' => 'form.site', 'translation_domain' => 'FOSUserBundle'))
            ->add('webMoneyR', null, array('label' => 'form.webMoneyR', 'translation_domain' => 'FOSUserBundle'))
            ->add('yandexMoney', null, array('label' => 'form.yandexMoney', 'translation_domain' => 'FOSUserBundle'))
                
            ->remove('current_password')
            ->remove('username')
        ;
    }

    public function getName()
    {
        return 'stalk_user_profile';
    }
}