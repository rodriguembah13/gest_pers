<?php

namespace App\Repository;

use App\Entity\Rhlignereglestructure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Rhlignereglestructure|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rhlignereglestructure|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rhlignereglestructure[]    findAll()
 * @method Rhlignereglestructure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RhlignereglestructureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rhlignereglestructure::class);
    }

    // /**
    //  * @return Rhlignereglestructure[] Returns an array of Rhlignereglestructure objects
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
    public function findOneBySomeField($value): ?Rhlignereglestructure
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
