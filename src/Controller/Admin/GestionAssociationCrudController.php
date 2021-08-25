<?php

namespace App\Controller\Admin;

use App\Entity\GestionAssociation;
use Vich\UploaderBundle\Form\Type\VichFileType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\DomCrawler\Field\FileFormField;

class GestionAssociationCrudController extends AbstractCrudController
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public static function getEntityFqcn(): string
    {
        return GestionAssociation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('numero_recipice'),
            TextField::new('recipissesFile', 'Téléverser le récipissé (PDF)')
                    ->setFormType(VichFileType::class, [
                        'delete_label' => 'supprimer?'
                    ])
                    ->onlyWhenCreating(),
            // TextField::new('recipisses', 'Récipissé')
            //         ->setTemplatePath('recipisses.html.twig')
            //         ->setCustomOption('base_path', $this->params->get('uploads_recipisses')),
            ImageField::new('recipisses', 'Fichier')
                    ->setBasePath('/uploads/recipisses')
                    ->hideOnForm(),
            TextField::new('denomination'),

            // information de localisation section
            TextField::new('adresse_siege')->hideOnIndex(),
            AssociationField::new('regions'),
            // on doit filtrer les departements dès que la region est donnée
            AssociationField::new('departements'),
            ChoiceField::new('geolocalisation')->setChoices([
                'Étrangère' => 'Etrangere',
                'National' => 'National',
            ])->allowMultipleChoices()->onlyOnForms(),

            //Informations supplémentaires sur l'association
            ChoiceField::new('grande_rubrique')->setChoices([
                'GR1' => 'GR1',
                'GR2' => 'GR2',
                'GR3' => 'GR3',
            ])->allowMultipleChoices()->hideOnIndex(),
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
