<?php

namespace App\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use App\FrontBundle\DataTransformer\DatetoStringTransformer;

class PlayerType extends AbstractType
{
    private $is_admin;
    
    public function __construct($is_admin = false) {
        $this->is_admin = $is_admin;
    }
    
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
            ->add($builder->create('dob', 'text', array('label' => 'Date of Birth', 'attr' => array('readonly' => true)))->addModelTransformer($dateTransformer))
            ->add('birthPlace')
            ->add('perAddress', 'textarea', array('label' => 'Permanent Address'))
            ->add('email')
            ->add('tel', 'text', array('label' => 'Land line Phone No', 'required' => false))
            ->add('mob', 'text', array('label' => 'Mobile No'))
            ->add('schoolAddress', 'textarea', array('label' => 'College/School Address', 'required' => false))
            ->add('studyClass', 'text', array('required' => false))
            ->add('officeAddress', 'textarea', array('required' => false))
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
            ->add('passportName', 'text', array('required' => false))
            ->add('otherName', 'text', array('required' => false))
            ->add('passportNo', 'text', array('required' => false))
            ->add('passportIssuePlace', 'text', array('required' => false))
            ->add($builder->create('passportIssueDate', 'text', array('required' => false, 'attr' => array('readonly' => true)))->addModelTransformer($dateTransformer))
            ->add($builder->create('passportExpiryDate', 'text', array('required' => false, 'attr' => array('readonly' => true)))->addModelTransformer($dateTransformer))
            ->add('height', 'number', array('label' => 'Height(cms)'))
            ->add('weight', 'number', array('label' => 'Weight(kgs)'))
            ->add('year', 'number', array('label' => 'Year of registration'))
            ->add('photo', 'file', array('data_class' => null, 'required' => $isEdit))
            ->add('birthCertificate', 'file', array('data_class' => null, 'required' => $isEdit))
            ->add('birthState', 'entity', array(
                'class' => 'AppFrontBundle:State',
                'property' => 'stateName',
                'multiple' => false,
                'expanded' => false,
            ));
            
            $builder->add('Submit', 'submit', array('label' => 'player.submit', 'attr' => array('class' => 'btn-primary')));
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
