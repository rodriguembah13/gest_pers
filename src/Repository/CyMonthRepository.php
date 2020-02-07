<?php

namespace App\Repository;

use App\Entity\CyMonth;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CyMonth|null find($id, $lockMode = null, $lockVersion = null)
 * @method CyMonth|null findOneBy(array $criteria, array $orderBy = null)
 * @method CyMonth[]    findAll()
 * @method CyMonth[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CyMonthRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CyMonth::class);
    }

    // /**
    //  * @return CyMonth[] Returns an array of CyMonth objects
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
    public function findOneBySomeField($value): ?CyMonth
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
