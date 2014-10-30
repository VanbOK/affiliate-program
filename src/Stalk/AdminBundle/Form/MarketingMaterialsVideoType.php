<?php

namespace Stalk\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MarketingMaterialsVideoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file')
            ->add('url')
            ->add('title')
            ->add('category', 'choice', array(
                'choices' => array(
                    'Модули' => 'Модули',
                    'IP-телефония' => 'IP-телефония',
                    'Разное' => 'Разное',
                ),
                'required' => true,
                'empty_value' => '- Выберите категорию -',
            ));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Stalk\AdminBundle\Entity\MarketingMaterialsVideo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'stalk_realtybundle_marketingmaterialsvideo';
    }
}
