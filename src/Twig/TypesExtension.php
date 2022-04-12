<?php


namespace App\Twig;

use App\Entity\Typeproduit;
use App\Repository\TypeproduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Twig\Extension\AbstractExtension;
use Doctrine\ORM\EntityManagerInterface;
use Twig\TwigFunction;

class TypesExtension extends AbstractController
{
    private $om;

    /**
     * 
     * @var TypeproduitRepository
     */
    private $repository;

    public function __construct(TypeproduitRepository $repository, EntityManagerInterface $om)
    {
        $this->repository = $repository;
        $this->om = $om;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('types', [$this, 'getTypes'])
        ];
    }
    public function getTypes()
    {
        return $this->repository->findAllOrderBy('nomtype', 'ASC');
    }
}
