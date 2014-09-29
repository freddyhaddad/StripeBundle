<?php

namespace WMC\StripeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CardFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('card', 'text', array('required' => true, 'attr' => array('data-stripe' => 'number')))
            ->add('cvc', 'integer', array('required' => true, 'attr' => array('data-stripe' => 'cvc')))
            ->add(
                'month',
                'choice',
                array(
                    'required' => true,
                    'attr' => array('data-stripe' => 'exp-month'),
                    'choices' => array_combine(range(1, 12), range(1, 12)),
                )
            )
            ->add(
                'year',
                'choice',
                array(
                    'required' => true,
                    'attr' => array('data-stripe' => 'exp-year'),
                    'choices' => array_combine(range(date('Y'), date('Y') + 10), range(date('Y'), date('Y') + 10)),
                )
            )
            ->add('token', 'hidden');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array()
        );
    }

    public function getName()
    {
        return 'wmc_stripebundle_cardformtype';
    }
}
