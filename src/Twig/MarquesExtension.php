<?php


namespace App\Twig;

use App\Entity\Marque;
use App\Repository\MarqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Twig\Extension\AbstractExtension;
use Doctrine\ORM\EntityManagerInterface;
use Twig\TwigFunction;

class MarquesExtension extends AbstractController
{
    private $om;

    /**
     * 
     * @var MarqueRepository
     */
    private $repository;

    public function __construct(MarqueRepository $repository, EntityManagerInterface $om)
    {
        $this->repository = $repository;
        $this->om = $om;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('marques', [$this, 'getMarques'])
        ];
    }
    public function getMarques()
    {
        return $this->repository->findAllOrderBy('nommarque', 'ASC');
    }
}
