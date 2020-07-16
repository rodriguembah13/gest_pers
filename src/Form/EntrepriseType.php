<?php

namespace App\Form;

use App\Entity\Entreprise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntrepriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('adresse')
            ->add('telephone')
            ->add('pays')
            ->add('capital')
            ->add('directeur')
            ->add('dateAutorisation', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'required' => false,
                'empty_data' => '',
            ])
            ->add('autorisation')
            ->add('fax')
            ->add('email')
            ->add('ville')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entreprise::class,
        ]);
    }
}
