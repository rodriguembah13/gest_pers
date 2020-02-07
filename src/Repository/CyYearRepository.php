<?php

namespace App\Repository;

use App\Entity\CyYear;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CyYear|null find($id, $lockMode = null, $lockVersion = null)
 * @method CyYear|null findOneBy(array $criteria, array $orderBy = null)
 * @method CyYear[]    findAll()
 * @method CyYear[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CyYearRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CyYear::class);
    }

    // /**
    //  * @return CyYear[] Returns an array of CyYear objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CyYear
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
