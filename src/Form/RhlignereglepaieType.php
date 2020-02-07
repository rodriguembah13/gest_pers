<?php

namespace App\Form;

use App\Entity\Rhlignereglepaie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RhlignereglepaieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('quantite')
            ->add('total')
            ->add('rhBulletinPaie')
            ->add('rhreglesalaire')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rhlignereglepaie::class,
        ]);
    }
}
