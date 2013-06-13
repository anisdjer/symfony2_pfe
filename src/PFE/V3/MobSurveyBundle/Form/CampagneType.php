<?php

namespace PFE\V3\MobSurveyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CampagneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('dateCreation', 'date' , array(
                                            'label' => 'Date Creation',
                                            'data' => new \DateTime("now"),
                                            'widget' => 'single_text',
                                            'format' => 'yyyy-MM-dd',
                                        )
        )
        ->add('description');
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PFE\V3\MobSurveyBundle\Entity\Campagne'
        ));
    }

    public function getName()
    {
        return 'pfe_v3_mobsurveybundle_campagnetype';
    }
}
