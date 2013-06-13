<?php

namespace PFE\V3\MobSurveyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SuperviseurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('email')
            ->add('password' , 'password')
            ->add('photo','file', array( 'data_class' => null, 'required' => false) )
            ->add('path')
            ->add('nom')
            ->add('prenom')
            ->add('cin')
            ->add('tel')
            ->add('address')

        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PFE\V3\MobSurveyBundle\Entity\Superviseur'
        ));
    }

    public function getName()
    {
        return 'pfe_v3_mobsurveybundle_superviseurtype';
    }
}
