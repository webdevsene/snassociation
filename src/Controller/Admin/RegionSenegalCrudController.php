<?php

namespace App\Controller\Admin;

use App\Entity\RegionSenegal;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RegionSenegalCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RegionSenegal::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('code'),
            TextField::new('nomreg'),
        ];
    }
}
