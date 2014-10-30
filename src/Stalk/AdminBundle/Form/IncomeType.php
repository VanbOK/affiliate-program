<?php

namespace Stalk\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class IncomeType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('payment')
            ->add('closeDate')
            ->add('status', 'choice', array(
                'choices' => array(
                    'expected' => 'ожидается',
                    'payment' => 'выплата',
                    'paid' => 'выплачено',
                ),
                'required' => true,
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Stalk\AdminBundle\Entity\Income'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'stalk_adminbundle_income';
    }
}
