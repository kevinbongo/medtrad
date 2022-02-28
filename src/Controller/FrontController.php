<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Produit;
use App\Entity\User;
use App\Repository\PostRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class FrontController extends AbstractController
{
    /**
     * 
     * @var ProduitRepository
     */
    private $produitrepository;
    /**
     * 
     * @var PostRepository
     */
    private $postrepository;
    /**
     * 
     * @var EntityManagerInterface
     */
    private $om;
    /**
     * 
     * @param EnvironnementRepository $repository
     */
    public function __construct(ProduitRepository $produitrepository, PostRepository $postrepository,  EntityManagerInterface $om)
    {
        $this->produitrepository = $produitrepository;
        $this->postrepository = $postrepository;
        $this->om = $om;
    }





    public function index(UserPasswordEncoderInterface $encoder): Response
    {
        phpinfo();
        $user = new User();
        $plainPassword = 'MyMedi225';
        $encoded = $encoder->encodePassword($user, $plainPassword);
        $produitsrecents = $this->produitrepository->findRecentProducts();
        var_dump($encoded);
        return $this->render('pages/accueil.html.twig', [
            'produitsrecents' => $produitsrecents

        ]);
    }

    public function ProduitsParCategories(Categorie $categorie): Response
    {
        $types = $categorie->getTypes();
        $produits = [];
        foreach ($types as $type) {
            $produits = array_merge($produits, $this->produitrepository->findProductsByTypes($type));
        }
        $nombredeproduits = count($produits);
        return $this->render('pages/categories.html.twig', [
            'produits' => $produits,
            'categorie' => $categorie,
            'nombredeproduits' => $nombredeproduits
        ]);
    }

    public function ResultatsFiltre(Categorie $categorie, Request $request): Response
    {
        echo 'test';
        $types = $categorie->getTypes();
        $produits = [];
        foreach ($types as $type) {
            $produits = array_merge($produits, $this->produitrepository->findProductsByTypes($type));
        }
        $min = $request->get('min');
        $max = $request->get('max');
        $marques = $request->get('marques');
        $notes = $request->get('notes');
        $produitsfiltre = $this->produitrepository->findSearch($min, $max, $marques, $notes);
        $produits = array_intersect($produits, $produitsfiltre);
        $nombredeproduits = count($produits);

        return $this->render('pages/categories.html.twig', [
            'produits' => $produits,
            'categorie' => $categorie,
            'nombredeproduits' => $nombredeproduits
        ]);
    }

    public function Contact(): Response
    {
        return $this->render('pages/contact.html.twig');
    }

    public function AffichageBlog(): Response
    {
        $posts = $this->postrepository->findAll();
        return $this->render('pages/blog.html.twig', [
            'posts' => $posts
        ]);
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

    public function AffichageProduitDetail($id): Response
    {
        $produit = $this->produitrepository->find($id);
        return $this->render('pages/produitdetail.html.twig', [
            'produit' => $produit
        ]);
    }

    public function AffichagePostDetail($id): Response
    {
        $post = $this->postrepository->find($id);
        return $this->render('pages/postdetail.html.twig', [
            'post' => $post
        ]);
    }
}
