<?php

namespace App\Form;

use App\Entity\ExperienceEmploye;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExperienceEmployeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titreFonction')
            ->add('employeur')
            ->add('adresse')
            ->add('dateDebut', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'required' => false,
                'empty_data' => '',
            ])
            ->add('dateFin', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'required' => false,
                'empty_data' => '',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ExperienceEmploye::class,
        ]);
    }
}
