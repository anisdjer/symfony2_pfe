<?php

namespace PFE\V3\MobSurveyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EnqueteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description')
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
            ->add('campagne')
            ->add("equipes")
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PFE\V3\MobSurveyBundle\Entity\Enquete'
        ));
    }

    public function getName()
    {
        return 'pfe_v3_mobsurveybundle_enquetetype';
    }
}
