<?php

namespace PFE\V3\MobSurveyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('texte')
            ->add('obligatoire', null , array(
                                        'label' => 'Obligatoire',
                                        'data' => false
                                    ))
            ->add('q_type')
            ->add('questionnaire')
            ->add('questionSuivante')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PFE\V3\MobSurveyBundle\Entity\Question'
        ));
    }

    public function getName()
    {
        return 'pfe_v3_mobsurveybundle_questiontype';
    }
}
