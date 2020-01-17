<?php

namespace App\Form;

use App\Entity\CaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CaTypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $options = [
            'Par Departement' => 'departement',
            'Par Poste' => 'poste',
            'Par societe' => 'entreprise',
        ];

        $builder
            ->add('libelle')
            ->add('code')
            ->add('paid', CheckboxType::class, [
                'required' => false,
                'label' => 'paid',
            ])
            ->add('nbreJours', NumberType::class, [
                'required' => false,
                'label' => 'Nombre de Jours',
            ])
            ->add('dateDebut', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'required' => false,
                'label' => 'Periode allant du',
            ])
            ->add('dateFin', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'required' => false,
                'label' => 'Jusqu au',
            ])
            ->add('mode', ChoiceType::class, [
                'choices' => $options,
            ])
            ->add('departement', EntityType::class, [
                'class' => 'App\Entity\Departement',
                'placeholder' => 'Sélectionnez votre Departement',
                'required' => false,
                'attr' => ['class' => 'selectpicker', 'data-size' => 5, 'data-live-search' => true, 'id' => 'departement_type'],
            ])
            ->add('entreprise', EntityType::class, [
                'class' => 'App\Entity\Entreprise',
                'placeholder' => 'Sélectionnez votre Entreprise',
                'required' => false,
                'attr' => ['class' => 'selectpicker', 'data-size' => 5, 'data-live-search' => true],
            ])
            ->add('poste', EntityType::class, [
                'class' => 'App\Entity\Poste',
                'placeholder' => 'Sélectionnez votre Poste',
                'required' => false,
                'attr' => ['class' => 'selectpicker', 'data-size' => 5, 'data-live-search' => true],
            ])
           // ->add('actif')//->add('mode')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CaType::class,
        ]);
    }
}
