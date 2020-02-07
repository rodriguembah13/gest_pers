<?php

namespace App\Form;

use App\Entity\AdvanceSalaire;
use App\Entity\Employe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdvanceSalaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('libelle')
            //->add('created')
            ->add('montant')
           // ->add('month')
            //->add('year')
            ->add('echance')
            ->add('employe', EntityType::class, [
                'class' => Employe::class,
                'multiple' => false,
                'attr' => ['class' => 'selectpicker', 'data-size' => 5, 'data-live-search' => true],
            ])
            //->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AdvanceSalaire::class,
        ]);
    }
}
