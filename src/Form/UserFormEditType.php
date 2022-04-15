<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserFormEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('Pseudo', TextType::class)
        ->add('email', TextType::class)
        // Password ne peut etre modifié par ce biais là.
        // ->add('password', PasswordType::class)
        ->add('imageFile', VichImageType::class, [
            'required' => false,
            // 'allow_delete' => true,
            // 'download_link' => true,
        ]);
     
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
