<?php

namespace Stalk\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TransactionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array('label'=>'Название'))
            ->add('amount', null, array('label'=>'Сумма сделки'))
            ->add('status', 'choice', array(
                'choices' => array(
                    'notConfirmed' => 'не подтверждён',
                    'active' => 'активен',
                ),
                'required' => true,
                'label' => 'Статус'
            ))
            ->add('income', 'collection', array(
                'type' => new IncomeType(),
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
            'data_class' => 'Stalk\AdminBundle\Entity\Transaction'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'stalk_adminbundle_transaction';
    }
}
