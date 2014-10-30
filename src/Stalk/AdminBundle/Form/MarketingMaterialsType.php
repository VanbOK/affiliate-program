<?php

namespace Stalk\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MarketingMaterialsType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', null, array('label'=>'Описание'))
            ->add('presentationDescription', null, array('label'=>'Описание'))
            ->add('portfolioDescription', null, array('label'=>'Описание'))
            ->add('videoDescription', null, array('label'=>'Описание'))
            ->add('priceDescription', null, array('label'=>'Описание'))
            //PDF
            ->add('pdf', 'collection', array(
                'type' => new MarketingMaterialsPdfType(),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true
               ))
            //Изображения
            ->add('image', 'collection', array(
                'type' => new MarketingMaterialsImageType(),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true
               ))
            //Видео
            ->add('video', 'collection', array(
                'type' => new MarketingMaterialsVideoType(),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true
               ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Stalk\AdminBundle\Entity\MarketingMaterials'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'stalk_adminbundle_marketingmaterials';
    }
}
