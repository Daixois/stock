<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            // Pour l'instant pas besoin de roles mais je prépare au cas ou
            // ->add('roles' ChoiceType::class, [
            //     'choices' => [
            //         'ROLE_ADMIN' => 'ROLE_ADMIN',
            //         'ROLE_USER' => 'ROLE_USER',
            //     ],
            // 'multiple' => true,
            // 'expanded' => true,
            // ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'mapped' => false,
                'required' => false,
            ])   

            ->add('pseudo');
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}