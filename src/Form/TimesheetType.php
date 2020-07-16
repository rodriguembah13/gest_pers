<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\Timesheet;
use App\Repository\ActivityRepository;
use App\Repository\ProjectRepository;
use App\Util\Form\DateTimePickerType;
use App\Util\Form\DurationType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class TimesheetType extends AbstractType
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
            ->add('project', EntityType::class, [
                'class' => Project::class,
                'placeholder' => 'choisir un project',
                'multiple' => false,
                'choices' => $projects,
                'required' => true,
                'attr' => ['class' => 'selectpicker', 'data-size' => 5, 'data-live-search' => true], ])
            //->add('activity')
            //->add('employe')
;
        $formModifier = function (FormInterface $form, Project $project = null) {
            $activities = null === $project ? [] : $project->getActivities();
            $teams = null === $project ? [] : $project->getTeams();
            $employes = [];
            foreach ($teams as $team) {
                $employes[] = $team->getMembers();
            }
            /* $form->add('employe', EntityType::class, [
                 'class' => 'App\Entity\Employe',
                 'placeholder' => '',
                 'choices' => $employes,
                 'required' => false,
             ]);*/
            $form->add('activity', EntityType::class, [
                'class' => 'App\Entity\Activity',
                'placeholder' => '',
                'choices' => $activities,
                'required' => false,
               // 'attr' => ['class' => 'selectpicker', 'data-size' => 5, 'data-live-search' => true],
            ]);
        };
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                $data = $event->getData();
                $formModifier($event->getForm(), $data->getProject());
            }
        );
        $builder->get('project')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $project = $event->getForm()->getData();

                $formModifier($event->getForm()->getParent(), $project);
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Timesheet::class,
        ]);
    }
}
