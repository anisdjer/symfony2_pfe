<?php

namespace PFE\V3\MobSurveyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GroupeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PFE\V3\MobSurveyBundle\Entity\Groupe'
        ));
    }

    public function getName()
    {
        return 'pfe_v3_mobsurveybundle_groupetype';
    }
}
