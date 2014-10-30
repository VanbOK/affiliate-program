<?php

namespace Stalk\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle', 'disabled' => true))
            ->add('firstname', null, array('label' => 'form.firstname', 'translation_domain' => 'FOSUserBundle'))
            ->add('surname', null, array('label' => 'form.surname', 'translation_domain' => 'FOSUserBundle'))
            ->add('phone', null, array('label' => 'form.phone', 'translation_domain' => 'FOSUserBundle'))
            ->add('company', null, array('label' => 'form.company', 'translation_domain' => 'FOSUserBundle'))
            ->add('site', null, array('label' => 'form.site', 'translation_domain' => 'FOSUserBundle'))
            ->add('webMoneyR', null, array('label' => 'form.webMoneyR', 'translation_domain' => 'FOSUserBundle'))
            ->add('yandexMoney', null, array('label' => 'form.yandexMoney', 'translation_domain' => 'FOSUserBundle'))
            ->add('roles','choice', array(
                'label' => 'Роли',
                'multiple'=>true,
                'empty_value' => 'Выберите роль',
                'choices'   => array('ROLE_USER' => 'Пользователь', 'ROLE_ADMIN' => 'Администратор'),
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Stalk\UserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'stalk_userbundle_user';
    }
}
