<?php

namespace App\Controller\Admin;

use App\Entity\GestionAssociation;
use Vich\UploaderBundle\Form\Type\VichFileType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

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
        $filename = TextareaField::new('filename', 'Recipisse')
                            ->setTemplatePath('associationhead/recipisses.html.twig')
                            ->setCustomOption('base_path', $this->params->get('app.path.uploads_files'))
                            ->hideOnForm();

        return [
            FormField::addPanel('Basic informations')
                    ->setIcon('fas fa-phone'),
                TextField::new('numero_recipice')
                    ->setColumns('col-sm-4 col-lg-3 col-xxl-3'),
                TextField::new('denomination')
                    ->setColumns('col-sm-4 col-lg-3 col-xxl-3'),
                TextareaField::new('file')
                    ->setFormType(VichFileType::class, [
                        'delete_label' => 'supprimer?'
                        ])
                    ->setLabel('Charger un récipissé')
                    ->setColumns('col-sm-4 col-lg-3 col-xxl-3')
                    ->onlyOnForms(),
                $filename,

            // information de localisation section
            FormField::addPanel('Localisation géographique')
                    ->setIcon('fas fa-map'),
                    TextField::new('adresse_siege')
                    ->setColumns('col-sm-4 col-lg-3 col-xxl-3')
                    ->hideOnIndex(),
                    AssociationField::new('regions')
                    ->setColumns('col-sm-4 col-lg-3 col-xxl-3'),
                    // on doit filtrer les departements dès que la region est donnée
                    AssociationField::new('departements')
                    ->setColumns('col-sm-4 col-lg-5 col-xxl-3'),
                    ChoiceField::new('geolocalisation')
                    ->setColumns('col-sm-4 col-lg-5 col-xxl-3')
                    ->setChoices([
                        'Étrangère' => 'ETRANGERE',
                        'National' => 'NATIONAL',
                        ])->allowMultipleChoices()->onlyOnForms(),

            FormField::addPanel('Information s supplémentaire s')
                    ->setIcon('fas fa-info'),
            //Informations supplémentaires sur l'association
                ChoiceField::new('grande_rubrique')->setChoices([
                    'ASSOCIATION' => 'ASSOCIATION',
                    'SYNDICAT' => 'SYNDICAT',
                    'PARTI POLITIQUE' => 'PARTI POLITIQUE',
                    'ONG' => 'ORGANISATION NON GOUVERNEMENTALE',
                ])->allowMultipleChoices()
                    ->setColumns('col-sm-4 col-lg-3 col-xxl-3')
                    ->hideOnIndex(),
                AssociationField::new('types', 'Catégorie s')
                    ->setColumns('col-sm-4 col-lg-3 col-xxl-3')
                    ->hideOnIndex(),
                DateTimeField::new('date_signature')
                    ->setFormTypeOptions([
                                'html5' => true,
                                'years' => range(date('Y'), date('Y') + 5),
                                'widget' => 'single_text',
                            ])
                    ->setColumns('col-sm-4 col-lg-3 col-xxl-3'),

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

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
}
