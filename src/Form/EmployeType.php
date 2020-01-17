<?php

namespace App\Form;

use App\Entity\Departement;
use App\Entity\Employe;
use App\Repository\PosteRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;

class EmployeType extends AbstractType
{
    private $posteRepository;

    /**
     * EmployeType constructor.
     *
     * @param $posteRepository
     */
    public function __construct(PosteRepository $posteRepository)
    {
        $this->posteRepository = $posteRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomComplet', TextType::class, [
                'required' => false,
                'empty_data' => '',
            ])
            //->add('matricule')
            ->add('telephone', TextType::class, [
                'required' => false,
                'empty_data' => '',
            ])
            ->add('adresse', TextType::class, [
                'required' => false,
                'empty_data' => '',
            ])
            ->add('email', EmailType::class, [
                'required' => false,
                'empty_data' => '',
                'constraints' => new Email(),
            ])
            ->add('nationalite', TextType::class, [
                'required' => false,
                'empty_data' => '',
            ])
            ->add('cni', TextType::class, [
                'required' => false,
                'empty_data' => '',
            ])
            ->add('passeport', TextType::class, [
                'required' => false,
                'empty_data' => '',
            ])
            ->add('sexe', ChoiceType::class, [
                'choices' => ['Masculin' => 'masculin', 'Feminin' => 'feminin'],
                'help' => 'Choisir le sexe', 'required' => false,
                'empty_data' => '',
            ])
            ->add('dateNaissance', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'required' => false,
                'empty_data' => '',
            ])
            ->add('imageFilename', FileType::class, [
                'mapped' => false,
                'required' => false,
                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                /*'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ]*/
            ])
            ->add('lieuNaissance', TextType::class, [
                'required' => false,
                'empty_data' => '',
            ])
            ->add('etatCivil', TextType::class, [
                'required' => false,
                'empty_data' => '',
            ])
           ->add('departement', EntityType::class, [
                'class' => 'App\Entity\Departement',
                'placeholder' => 'Sélectionnez votre Departement',
                'mapped' => true,
                'required' => false,
            ])
            ->add('noteAdditionnelle', TextareaType::class, [
                'required' => false, 'empty_data' => '',
            ])
        ;
        $formModifier = function (FormInterface $form, Departement $sport = null) {
            $positions = null === $sport ? [] : $sport->getPostes();

            $form->add('poste', EntityType::class, [
                'class' => 'App\Entity\Poste',
                'placeholder' => '',
                'choices' => $positions,
                'required' => false,
            ]);
        };
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();
                $formModifier($event->getForm(), $data->getDepartement());
            }
        );
        $builder->get('departement')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $sport = $event->getForm()->getData();

                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback functions!
                $formModifier($event->getForm()->getParent(), $sport);
            }
        );
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $entity = $form->getData();
        if ($entity) {
            $view->vars['file_uri'] = (null === $entity->getImageFilename()) ? null : '/uploads'.$entity->getImageFilename();
        }
        /*dump($view);
        dump($form);
        dump($options);*/
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employe::class,
            'file_uri' => null,
        ]);
    }
}
