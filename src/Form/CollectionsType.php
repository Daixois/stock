<?php

namespace App\Form;

use App\Entity\CollectionGenre;
use App\Entity\Collections;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CollectionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            
            ->add('Name', TextType::class)
            // ->add('Type', ChoiceType::class, [
            //     'choices' => [
            //         'Bande-Dessinee' => 'Bande-Dessinee',
            //         'Comics' => 'Comics',
            //         'Films' => 'Films',
            //         'Jeux-Video' => 'Jeux-Video',
            //         'Livres' => 'Livres',
            //         'Musiques' => 'Musiques',
            //     ],
            //     'multiple' => false,
            //     'expanded' => true
            // ])
            ->add('imageFile', VichImageType::class , [
                'required' => false,
                // 'allow_delete' => true,
                // 'download_link' => true,
            ])
            ->add('Save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Collections::class,
        ]);
    }
}