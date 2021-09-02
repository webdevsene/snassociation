<?php

namespace App\Controller\Admin;

use App\Entity\TypeAssociation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;

class TypeAssociationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeAssociation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('cote'),
            TextField::new('description'),
            SlugField::new('slug')->setTargetFieldName('cote'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
        ;
    }
}
