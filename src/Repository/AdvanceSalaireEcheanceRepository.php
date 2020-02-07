<?php

namespace App\Repository;

use App\Entity\AdvanceSalaireEcheance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AdvanceSalaireEcheance|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdvanceSalaireEcheance|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdvanceSalaireEcheance[]    findAll()
 * @method AdvanceSalaireEcheance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvanceSalaireEcheanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdvanceSalaireEcheance::class);
    }

    // /**
    //  * @return AdvanceSalaireEcheance[] Returns an array of AdvanceSalaireEcheance objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AdvanceSalaireEcheance
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
