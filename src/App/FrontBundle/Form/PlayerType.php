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
            ->add('dob')
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
            ->add('passportIssueDate')
            ->add('passportExpiryDate')
            ->add('height')
            ->add('weight')
            ->add('year')
            ->add('playerId')
            ->add('photo')
            ->add('birthCertificate')
            ->add('birthState')
            ->add('district')
        ;
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
