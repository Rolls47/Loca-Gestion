<?php

namespace App\Controller\Admin;

use App\Entity\Label;
use App\Entity\Location;
use App\Entity\LocationAccounting;
use App\Entity\OperationType;
use App\Entity\Property;
use App\Entity\PropertyAccounting;
use App\Entity\PropertyType;
use App\Entity\User;
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
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Loca Gestion');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('CRUD', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateur ', 'fa fa-home', User::class);
        yield MenuItem::linkToCrud('Localisation ', 'fa fa-home', Location::class);
        yield MenuItem::linkToCrud('Propriété', 'fa fa-home', Property::class);
        yield MenuItem::linkToCrud('Compta localisation', 'fa fa-home', LocationAccounting::class);
        yield MenuItem::linkToCrud('Compta propriété', 'fa fa-home', PropertyAccounting::class);
        yield MenuItem::linkToCrud('Type de propriété', 'fa fa-home', PropertyType::class);
        yield MenuItem::linkToCrud('Type d\'opération', 'fa fa-home', OperationType::class);
        yield MenuItem::linkToCrud('Label', 'fa fa-home', Label::class);
    }
}
