<?php

namespace App\Form;

use App\Entity\CaConge;
use App\Entity\CaType;
use App\Entity\Employe;
use App\Repository\CaTypeRepository;
use App\Repository\EmployeRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class MyCaCongeType extends AbstractType
{
    private $typeRepository;
    private $security;

    /**
     * MyCaCongeType constructor.
     */
    public function __construct(CaTypeRepository $caTypeRepository, Security $security)
    {
        $this->typeRepository = $caTypeRepository;
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $employe = $this->security->getUser()->getEmploye();
        $data = $this->typeRepository->findByEmployeField($employe);
        $builder
            //->add('libelle')
            ->add('dateDebut', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'required' => false,
            ])
            ->add('dateFin', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'required' => false,
            ])
            ->add('nbreJours', TextType::class, [
                'attr' => ['readonly' => true],
            ])
            ->add('status')

            ->add('type', EntityType::class, [
                'class' => CaType::class,
             'choices' => $data,
                'multiple' => false,
                'attr' => ['class' => 'selectpicker', 'data-size' => 5, 'data-live-search' => true],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CaConge::class,
        ]);
    }
}
