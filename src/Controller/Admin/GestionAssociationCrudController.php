<?php

namespace App\Controller\Admin;

use App\Entity\GestionAssociation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;

class GestionAssociationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return GestionAssociation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('numero_recipice'),
            TextField::new('denomination'),
            TextField::new('adresse_siege')->hideOnIndex(),
            AssociationField::new('regions'),
            // on doit filtrer les departements dès que la region est donnée
            AssociationField::new('departements'),
            ChoiceField::new('geolocalisation')->setChoices([
                'Étrangère' => 'Etrangere',
                'National' => 'National',
            ])->allowMultipleChoices()->onlyOnForms(),
            //TextField::new('type'),
            ChoiceField::new('grande_rubrique')->setChoices([
                'GR1' => 'GR1',
                'GR2' => 'GR2',
                'GR3' => 'GR3',
            ])->allowMultipleChoices()->hideOnIndex(),
            // ChoiceField::new('type')->setChoices([
            //     'Association Sportive et Culturelle' => '(ASC)',
            //     'Association Religieuse (AR)' => '(AR)',
            //     'Association Professionnelle (APROF)' => '(APROF)',
            //     'Association Educative (ED)' => '(ED)',
            //     'Syndicat' => 'Syndicat',
            //     'Parti Politique' => 'Parti Politique',
            //     'Organisation Non Gouvernementale (ONG)' => '(ONG)',
            //     'Organisation de Minorité Sexuel' => 'Organisation de Minorité Sexuel',
            //     'Association' => 'Association',
            // ]),
            AssociationField::new('types')->hideOnIndex(),
            DateTimeField::new('date_signature')->setFormTypeOptions([
                            'html5' => true,
                            'years' => range(date('Y'), date('Y') + 5),
                            'widget' => 'single_text',
                        ]),
            SlugField::new('slug')->setTargetFieldName('denomination')->hideOnIndex(),
        ];

    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            //->setDefaultSort(['date_signature' => "ASC"])
            ->setDefaultSort(['id' => "DESC"])
        ;
    }
}
