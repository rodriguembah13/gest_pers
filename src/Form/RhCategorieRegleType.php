<?php

namespace App\Form;

use App\Entity\RhCategorieRegle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\NotNull;

class RhCategorieRegleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $radios = [
            'Basic' => 'basic',
            'Net' => 'net',
            'Deduction' => 'deduction',
            'Allocation' => 'allocation',

        ];
        $builder
            ->add('libelle')
            ->add('code')
            ->add('description')
            ->add('operation', ChoiceType::class, [
                'choices' => $radios,
                'expanded' => true,
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RhCategorieRegle::class,
        ]);
    }
}
