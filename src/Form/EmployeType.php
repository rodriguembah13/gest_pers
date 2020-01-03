<?php

namespace App\Form;

use App\Entity\Employe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;

class EmployeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomComplet')
            //->add('matricule')
            ->add('telephone')
            ->add('adresse')
            ->add('email', EmailType::class, [
                'required' => true,
                'constraints' => new Email(),
            ])
            ->add('nationalite')
            ->add('cni')
            ->add('passeport')
            ->add('sexe', ChoiceType::class, [
                'choices' => ['Masculin' => 'masculin', 'Feminin' => 'feminin'],
                'help' => 'Choisir le sexe', 'required' => false,
            ])
            ->add('dateNaissance', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'required' => false,
            ])
            ->add('lieuNaissance')
            ->add('etatCivil')
            ->add('poste')
            ->add('noteAdditionnelle', TextareaType::class, [
                'required' => false,
            ])/*->add('compte',CollectionType::class,
                [
                    'entry_type' => RegistrationType::class, // le formulaire enfant qui doit être répété
                    'allow_add' => true, // true si tu veux que l'utilisateur puisse en ajouter
                    'allow_delete' => false, // true si tu veux que l'utilisateur puisse en supprimer
                    'label' => 'Compte',
                    'by_reference' => false, // voir  https://symfony.com/doc/current/reference/forms/types/collection.html#by-reference

                ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employe::class,
        ]);
    }
}
