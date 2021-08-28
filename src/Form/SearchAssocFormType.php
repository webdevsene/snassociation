<?php

namespace App\Form;

use App\Entity\TypeAssociation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchAssocFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mots', SearchType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrer un ou plusieurs mot s'
                ],
                'required' => true,
                ])
                ->add('types', EntityType::class, [
                    'class' => TypeAssociation::class,
                    'label' => false,
                    'attr' => [
                        'class' => 'form-control',
                    ],
                    'required' => false,
                    'placeholder' => 'Entrer un ou plusieurs mot s'
            ])
            ->add('Rechercher', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary p-2 text-white',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
