<?php

namespace PFE\V3\MobSurveyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EquipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('superviseur')
            ->add('dateDebut', 'date' , array(
            'label' => 'Date Debut',
            'data' => new \DateTime("now"),
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd',
        ))
            ->add('dateFin', 'date' , array(
            'label' => 'Date Fin',
            'data' => new \DateTime("now"),
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd',
        ))
            ->add('enqueteurs')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PFE\V3\MobSurveyBundle\Entity\Equipe'
        ));
    }

    public function getName()
    {
        return 'pfe_v3_mobsurveybundle_equipetype';
    }
}
