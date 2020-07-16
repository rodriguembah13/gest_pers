<?php

namespace App\Form;

use App\Entity\WorkDay;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorkDayType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('heureDebut', TimeType::class, [
                'widget' => 'single_text',
                'required' => false,
                'empty_data' => '',
            ])
            ->add('heureFin', TimeType::class, [
                'widget' => 'single_text',
                'required' => false,
                'empty_data' => '',
            ])
            ->add('nombreHeure')
          //  ->add('entreprise')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WorkDay::class,
        ]);
    }
}
