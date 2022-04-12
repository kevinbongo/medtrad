<?php

namespace App\Repository;

use App\Entity\Typeproduit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Typeproduit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Typeproduit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Typeproduit[]    findAll()
 * @method Typeproduit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeproduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Typeproduit::class);
    }

    // /**
    //  * @return Typeproduit[] Returns an array of Typeproduit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Typeproduit
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
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
     * @return Typeproduit[]
     */
    public function findAllOrderBy($champ, $ordre): array
    {
        return $this->createQueryBuilder('v')
            ->orderBy('v.' . $champ, $ordre)
            ->getQuery()
            ->getResult();
    }
}
