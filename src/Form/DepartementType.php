<?php

namespace App\Form;

use App\Entity\Departement;
use App\Entity\Employe;
use App\Repository\EmployeRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DepartementType extends AbstractType
{
    private $employeRepository;

    /**
     * DepartementType constructor.
     *
     * @param $employeRepository
     */
    public function __construct(EmployeRepository $employeRepository)
    {
        $this->employeRepository = $employeRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $data = $this->employeRepository->findAll();
        $builder
            ->add('libelle')
            ->add('code')
            ->add('entreprise')
            ->add('responsable', EntityType::class, [
                'class' => Employe::class,
                'choices' => $data,
                'multiple' => false,
                'help' => 'Choose responsable',
                'attr' => ['class' => 'selectpicker', 'data-size' => 5, 'data-live-search' => true],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Departement::class,
        ]);
    }
}
