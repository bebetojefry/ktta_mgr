<?php

namespace App\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use App\FrontBundle\DataTransformer\DatetoStringTransformer;

class PlayerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $isEdit = ($builder->getData()->getId() == null); 
        $dateTransformer = new DatetoStringTransformer();
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('fatherName')
            ->add('motherName')
            ->add('gender', 'choice', array(
                'choices' => array('male' => 'Male', 'female' => 'Female'),
                'multiple' => false,
                'expanded' => false,
            ))
            ->add($builder->create('dob', 'text')->addModelTransformer($dateTransformer))
            ->add('birthPlace')
            ->add('perAddress')
            ->add('email')
            ->add('tel')
            ->add('mob')
            ->add('schoolAddress')
            ->add('studyClass')
            ->add('officeAddress')
            ->add('bloodGroup', 'choice', array(
                'choices' => array(
                    'O+' => 'O+',
                    'O-' => 'O-',
                    'A+' => 'A+',
                    'A-' => 'A-',
                    'B+' => 'B+',
                    'B-' => 'B-',
                    'AB+' => 'AB+',
                    'AB-' => 'AB-'
                ),
                'multiple' => false,
                'expanded' => false,
            ))
            ->add('passportName')
            ->add('otherName')
            ->add('passportNo')
            ->add('passportIssuePlace')
            ->add($builder->create('passportIssueDate', 'text')->addModelTransformer($dateTransformer))
            ->add($builder->create('passportExpiryDate', 'text')->addModelTransformer($dateTransformer))
            ->add('height')
            ->add('weight')
            ->add('year')
            ->add('photo', 'file', array('data_class' => null, 'required' => $isEdit))
            ->add('birthCertificate', 'file', array('data_class' => null, 'required' => $isEdit))
            ->add('birthState', 'entity', array(
                'class' => 'AppFrontBundle:State',
                'property' => 'stateName',
                'multiple' => false,
                'expanded' => false,
            ))
            ->add('Submit', 'submit', array('label' => 'player.submit'));
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
        return 'app_frontbundle_player';
    }
}
