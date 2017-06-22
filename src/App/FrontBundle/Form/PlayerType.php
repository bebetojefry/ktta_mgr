<?php

namespace App\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PlayerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('fatherName')
            ->add('motherName')
            ->add('gender')
            ->add('dob', 'text')
            ->add('birthPlace')
            ->add('perAddress')
            ->add('email')
            ->add('tel')
            ->add('mob')
            ->add('schoolAddress')
            ->add('studyClass')
            ->add('officeAddress')
            ->add('bloodGroup')
            ->add('passportName')
            ->add('otherName')
            ->add('passportNo')
            ->add('passportIssuePlace')
            ->add('passportIssueDate', 'text')
            ->add('passportExpiryDate', 'text')
            ->add('height')
            ->add('weight')
            ->add('year')
            ->add('playerId')
            ->add('photo')
            ->add('birthCertificate')
            ->add('birthState', 'entity', array(
                'class' => 'AppFrontBundle:State',
                'property' => 'stateName',
                'multiple' => false,
                'expanded' => false,
            ))
            ->add('district', 'entity', array(
                'class' => 'AppFrontBundle:District',
                'property' => 'name',
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
