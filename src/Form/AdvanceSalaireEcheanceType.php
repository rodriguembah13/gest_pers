<?php

namespace App\Form;

use App\Entity\AdvanceSalaireEcheance;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdvanceSalaireEcheanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('month')
            ->add('year')
            ->add('montant')
            ->add('statut')
            ->add('advanceSalaire')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AdvanceSalaireEcheance::class,
        ]);
    }
}
