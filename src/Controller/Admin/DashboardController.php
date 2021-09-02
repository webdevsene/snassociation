<?php

namespace App\Controller\Admin;

use App\Entity\Departement;
use App\Entity\GestionAssociation as Association;
use App\Entity\RegionSenegal;
use App\Entity\TypeAssociation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('associationhead/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Portail Gouvernance');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::section(''),
            MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home'),

            MenuItem::section('Gestion des entités'),
            MenuItem::subMenu('Gestion des entités')
                    ->setSubItems([
                        MenuItem::linkToCrud('Gestion associations', 'fas fa-list', Association::class),
                    ]),

            MenuItem::section('Tables de référence'),
            MenuItem::subMenu('Tables de référence', 'fa fa-list-alt')
            ->setCssClass('')
            ->setSubItems([

                MenuItem::linkToCrud('Gestion des Régions', 'fas fa-city', RegionSenegal::class),
                MenuItem::linkToCrud('Gestion des Départements', 'fas fa-map', Departement::class),
                MenuItem::linkToCrud('Type', 'fas fa-list', TypeAssociation::class),

            ]),




        ];
    }
}
