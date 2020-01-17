<?php

namespace App\Repository;

use App\Entity\Rhstructuresalaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Rhstructuresalaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rhstructuresalaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rhstructuresalaire[]    findAll()
 * @method Rhstructuresalaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RhstructuresalaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rhstructuresalaire::class);
    }

    // /**
    //  * @return Rhstructuresalaire[] Returns an array of Rhstructuresalaire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Rhstructuresalaire
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
