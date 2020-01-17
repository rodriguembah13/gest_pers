<?php

namespace App\Repository;

use App\Entity\Rhreglesalaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Rhreglesalaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rhreglesalaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rhreglesalaire[]    findAll()
 * @method Rhreglesalaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RhreglesalaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rhreglesalaire::class);
    }

    // /**
    //  * @return Rhreglesalaire[] Returns an array of Rhreglesalaire objects
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
    public function findOneBySomeField($value): ?Rhreglesalaire
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
