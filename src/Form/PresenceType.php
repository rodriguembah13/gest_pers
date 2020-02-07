<?php

namespace App\Form;

use App\Entity\Presence;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PresenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('heureArrivee', TimeType::class, [
                'widget' => 'single_text',
                'required' => false,
                'empty_data' => '',
            ])
            ->add('heureDepart', TimeType::class, [
                'widget' => 'single_text',
                'required' => false,
                'empty_data' => '',
            ])
            ->add('employe')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Presence::class,
        ]);
    }
}
