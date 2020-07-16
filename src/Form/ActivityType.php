<?php

namespace App\Form;

use App\Entity\Activity;
use App\Entity\Project;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActivityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('description')
            ->add('project', EntityType::class, [
                'class' => Project::class,
                'multiple' => false,
                'required' => true,
                'attr' => ['class' => 'selectpicker', 'data-size' => 5, 'data-live-search' => true],
            ])->add('visible');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Activity::class,
        ]);
    }
}
