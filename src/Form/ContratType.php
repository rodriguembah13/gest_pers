<?php

namespace App\Form;

use App\Entity\Contrat;
use App\Entity\Employe;
use App\Entity\TypeContrat;
use App\Repository\EmployeRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContratType extends AbstractType
{
    private $employeRepository;

    /**
     * ContratType constructor.
     *
     * @param $employeRepository
     */
    public function __construct(EmployeRepository $employeRepository)
    {
        $this->employeRepository = $employeRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //  $data = [];
        $data = $this->employeRepository->findAll();
        $builder
            ->add('libelle')
            ->add('employe', EntityType::class, [
                'class' => Employe::class,
                'choices' => $data,
                'multiple' => false,
                'attr' => ['class' => 'selectpicker', 'data-size' => 5, 'data-live-search' => true],
            ])
            ->add('type', EntityType::class, [
                'class' => TypeContrat::class,
                'attr' => ['class' => 'selectpicker', 'data-size' => 5, 'data-live-search' => true],
            ])
            ->add('finEssai', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'required' => false,
            ])
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
            ->add('salaire')

        ;
    }

    private function getEmployes(EmployeRepository $employeRepository)
    {
        return $employeRepository->findAll();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contrat::class,
        ]);
    }
}
