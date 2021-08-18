<?php

namespace App\Controller\Admin;

use App\Entity\Departement;
use App\Entity\GestionAssociation;
use App\Entity\RegionSenegal;
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
            ->setTitle('Snassociation');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home'),
            MenuItem::linkToCrud('Gestion des régions', 'fas fa-city', RegionSenegal::class),
            MenuItem::linkToCrud('Gestion des départements', 'fas fa-city', Departement::class),
            MenuItem::linkToCrud('Gestion associations', 'fas fa-city', GestionAssociation::class),


            MenuItem::section('Paramètrage'),
            MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', User::class)->setPermission('ROLE_ADMIN'),

        ];
    }
}
