<?php

namespace App\Form;

use App\Entity\Timesheet;
use App\Repository\ActivityRepository;
use App\Repository\ProjectRepository;
use App\Util\Form\DateTimePickerType;
use App\Util\Form\DurationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class TimesheetActivityType extends AbstractType
{
    private $activityRepository;
    private $projectRepository;
    private $security;

    /**
     * TimesheetType constructor.
     */
    public function __construct(ActivityRepository $activityRepository, Security $security, ProjectRepository $projectRepository)
    {
        $this->activityRepository = $activityRepository;
        $this->security = $security;
        $this->projectRepository = $projectRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $projects = $this->projectRepository->findByEmploye($this->security->getUser()->getEmploye());
        $builder
            ->add('libelle')
            ->add('description')
            ->add('dateDebut', DateTimePickerType::class, [
                'required' => false,
            ])
            ->add('dateFin', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'required' => false,
            ])
            ->add('duration', DurationType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => '00:00',
                ],
            ])

;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Timesheet::class,
        ]);
    }
}
