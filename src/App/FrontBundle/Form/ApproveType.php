<?php

namespace App\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use App\FrontBundle\DataTransformer\DatetoStringTransformer;

class ApproveType extends AbstractType
{    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $dateTransformer = new DatetoStringTransformer();
        $builder
            ->add('recieptNo', 'text', array('label' => 'Reciept No', 'required' => true))
            ->add($builder->create('payDate', 'text', array('label' => 'Date of payment', 'required' => true))->addModelTransformer($dateTransformer))
            ->add('Submit', 'submit', array('label' => 'player.submit', 'attr' => array('class' => 'btn-primary')));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\FrontBundle\Entity\Player'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'app_frontbundle_player_approve';
    }
}
