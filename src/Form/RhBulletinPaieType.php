<?php

namespace App\Form;

use App\Entity\Employe;
use App\Entity\RhBulletinPaie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RhBulletinPaieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('etat')
            ->add('periodeDebut', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'required' => false,
                'empty_data' => '',
            ])
           ->add('periodeFin', DateType::class, [
               'widget' => 'single_text',
               'html5' => false,
               'required' => false,
               'empty_data' => '',
           ])
            ->add('employe', EntityType::class, [
                'class' => 'App\Entity\Employe',
                'placeholder' => 'Sélectionnez un Employe',
                'mapped' => true,
                'required' => false,
                'attr' => ['class' => 'selectpicker', 'data-size' => 5, 'data-live-search' => true],
            ])
            ->add('rhstructurepaie', EntityType::class, [
                'class' => 'App\Entity\Rhstructuresalaire',
                'placeholder' => 'Sélectionnez un Structure',
                'required' => false,
                'attr' => ['class' => 'selectpicker', 'data-size' => 5, 'data-live-search' => true],
            ])
        ;
        $formModifier = function (FormInterface $form, Employe $employe = null) {
            $positions = null === $employe ? [] : $employe->getRhcontrats();

            $form->add('rhcontrat', EntityType::class, [
                'class' => 'App\Entity\Contrat',
                'placeholder' => '',
                'choices' => $positions,
                'required' => false,
            ]);
        };
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                $data = $event->getData();
                $formModifier($event->getForm(), $data->getEmploye());
            }
        );
        $builder->get('employe')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                $employe = $event->getForm()->getData();
                $formModifier($event->getForm()->getParent(), $employe);
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RhBulletinPaie::class,
        ]);
    }
}
