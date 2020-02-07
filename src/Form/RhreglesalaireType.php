<?php

namespace App\Form;

use App\Entity\Rhreglesalaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RhreglesalaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('code')
            ->add('description')
            ->add('sequencecalcul')
            ->add('quantite')
            ->add('pourcentage')
            ->add('montantfixe')
            ->add('expression')
            ->add('isvisible')
            ->add('registrecontribution')
            ->add('plagemin')
            ->add('plagemax')
            ->add('plagesur')
            ->add('pourcentagesur')
            ->add('codecalcul')
            ->add('rhcondition', ChoiceType::class, [
                'choices' => ['Toujours vrai' => 'toujours', 'Plage' => 'plage', 'Expression' => 'expression'],
                'label' => 'Condition',
            ])
            ->add('typecondition', ChoiceType::class, [
                'choices' => ['Montant Fixe' => 'montant', 'Pourcentage' => 'pourcentage', 'Expression' => 'expression'],
                'label' => 'Type de Montant',
            ])
            ->add('rhcategorieregle')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rhreglesalaire::class,
        ]);
    }
}
