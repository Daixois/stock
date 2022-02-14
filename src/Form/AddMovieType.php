<?php

namespace App\Form;

use App\Entity\Movie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddMovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('sort', ChoiceType::class, [
                'choices' => [
                    'Films' => [
                        'Blu-Ray' => 'Blu_ray',
                        'DVD' => 'DVD',
                        'SVOD' => 'SVOD'
                    ],
                    // 'Livres' => [
                    //     'Poche' => 'Poche',
                    //     'Broché' => 'Broché',
                    //     'Bande Dessinée' => 'BD',
                    //     'Comics' => 'Comics',
                    //     'Mangas' => 'Mangas',
                    //     'Livre Audio' => 'Audio'
                    // ],
                    // 'Musique' => [
                    //     'CD' => 'CD',
                    //     'Vinyle' => 'Vinyle',
                    //     'Numérique' => 'Numérique'
                    // ],

                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
