<?php

namespace App\Form;

use App\Entity\GestionAssociation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GestionAssociationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero_recipice')
            ->add('denomination')
            ->add('adresse_siege')
            ->add('geolocalisation')
            ->add('type')
            ->add('grande_rubrique')
            ->add('date_signature')
            ->add('regions')
            ->add('departements')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GestionAssociation::class,
        ]);
    }
}
