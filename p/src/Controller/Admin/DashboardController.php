<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/gestion", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Pneus28');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Produits', 'fas fa-shopping-cart', Product::class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-pager', Categories::class);
        yield MenuItem::linkToCrud('Paniers', 'fas fa-shopping-bag', Cart::class);
        yield MenuItem::linkToCrud('Commandes', 'fas fa-box-open', Orders::class);
        yield MenuItem::linkToCrud('Transport', 'fas fa-truck', Transport::class);
        yield MenuItem::linkToCrud('contact', 'fas fa-truck', Contact::class);
        yield MenuItem::linkToCrud('Accueil Slider', 'fas fa-envelope', AccueilSlider::class);
    }
}
