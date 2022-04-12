<?php

namespace App\Repository;

use App\Entity\Marque;
use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

    // /**
    //  * @return Produit[] Returns an array of Produit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Produit
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
     * 
     * @param type $champ
     * @param type $ordre
     * @return Produit[]
     */
    public function findAllOrderBy($champ, $ordre): array
    {
        return $this->createQueryBuilder('v')
            ->orderBy('v.' . $champ, $ordre)
            ->getQuery()
            ->getResult();
    }

    public function findRecentProducts(): array
    {
        return $this->createQueryBuilder('v')
            ->orderBy('v.datemiseenligne', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

    public function findProductsByTypes($type): array
    {
        return $this->createQueryBuilder('v')
            ->orderBy('v.datemiseenligne', 'DESC')
            ->andWhere('v.type = :type')
            ->setParameter('type', $type)
            ->getQuery()
            ->getResult();
    }


    /**
     * @return Produit[]
     */
    public function findSearch($prixmin, $prixmax, $marques, $notes): array
    {
        $query = $this
            ->createQueryBuilder('p')
            ->select('p');

        if (!empty($prixmin)) {
            $query = $query
                ->andWhere('p.prixunitaire >=:prixmin')
                ->setParameter('prixmin', $prixmin);
        }

        if (!empty($prixmax)) {
            $query = $query
                ->andWhere('p.prixunitaire <=:prixmax')
                ->setParameter('prixmax', $prixmax);
        }

        if (!empty($marques)) {
            $query = $query
                ->andWhere('p.marque IN (:marques)')
                ->setParameter('marques', $marques);
        }
        if (!empty($notes)) {
            $query = $query
                ->andWhere('p.noteproduit IN (:notes)')
                ->setParameter('notes', $notes);
        }
        $resultat = $query->getQuery()->getResult();
        var_dump($resultat);
        return $resultat;
    }
}
