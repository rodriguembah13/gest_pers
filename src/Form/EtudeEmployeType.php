<?php

namespace App\Form;

use App\Entity\EtudeEmploye;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudeEmployeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomEtablissement')
            ->add('optionEtude')
            ->add('diplome')
            ->add('date', DateType::class, [
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
            'data_class' => EtudeEmploye::class,
        ]);
    }
}
