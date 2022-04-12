<?php


namespace App\Twig;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Twig\Extension\AbstractExtension;
use Doctrine\ORM\EntityManagerInterface;
use Twig\TwigFunction;

class CatsExtension extends AbstractController
{
    private $om;

    /**
     * 
     * @var CategorieRepository
     */
    private $repository;

    public function __construct(CategorieRepository $repository, EntityManagerInterface $om)
    {
        $this->repository = $repository;
        $this->om = $om;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('cats', [$this, 'getCategories'])
        ];
    }
    public function getCategories()
    {
        return $this->repository->findAllOrderBy('nomcategorie', 'ASC');
    }
}
