<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{

    public function index(): Response
    {
        return $this->render('pages/accueil.html.twig');
    }

    public function ProduitsParCategories($categorie): Response
    {
        return $this->render('pages/categories.html.twig');
    }

    public function Contact(): Response
    {
        return $this->render('pages/contact.html.twig');
    }

    public function AffichageBlog(): Response
    {
        return $this->render('pages/blog.html.twig');
    }

    public function AffichageWishlist(): Response
    {
        return $this->render('pages/wishlist.html.twig');
    }

    public function AffichagePanier(): Response
    {
        return $this->render('pages/panier.html.twig');
    }

    public function AffichageCheckout(): Response
    {
        return $this->render('pages/checkout.html.twig');
    }
}
