<?php

namespace Stalk\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MarketingMaterialsPdfType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', null, array('label'=>'Файл: '))
            ->add('thumbnail', null, array('label'=>'Миниатюра: '))
            ->add('title')
            ->add('category', 'choice', array(
                'choices' => array(
                    'информация об услугах' => 'информация об услугах',
                    'кейсы' => 'кейсы',
                    'IP-телефония' => 'IP-телефония',
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
            'data_class' => 'Stalk\AdminBundle\Entity\MarketingMaterialsPdf'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'stalk_realtybundle_marketingmaterialspdf';
    }
}
