<?php

namespace App\Form;

use App\Entity\Employe;
use App\Entity\Group;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            /* ->add('username')
             ->add('usernameCanonical')
             ->add('email')
             ->add('emailCanonical')
             ->add('enabled')
             ->add('salt')
             ->add('password')
             ->add('lastLogin')
             ->add('confirmationToken')
             ->add('passwordRequestedAt')*/
            ->add('employe', EntityType::class, [
                'class' => Employe::class,
                'attr' => ['class' => 'selectpicker', 'data-size' => 5, 'data-live-search' => true], ])
            ->add('roles', ChoiceType::class, [
                'choices' => ['Administrateur' => 'ROLE_ADMIN', 'Manager' => 'ROLE_MANAGER', 'Utilisateur' => 'ROLE_USER'],
                'multiple' => true,
                'expanded' => true,
            ])
           /*->add('groups', EntityType::class, [
               'class' => Group::class,
                'multiple' => true,
            ])*/
           ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
