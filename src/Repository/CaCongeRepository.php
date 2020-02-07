<?php

namespace App\Repository;

use App\Entity\CaConge;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CaConge|null find($id, $lockMode = null, $lockVersion = null)
 * @method CaConge|null findOneBy(array $criteria, array $orderBy = null)
 * @method CaConge[]    findAll()
 * @method CaConge[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CaCongeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CaConge::class);
    }

    // /**
    //  * @return CaConge[] Returns an array of CaConge objects
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
    public function findByStaut($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.status = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(100)
            ->getQuery()
            ->getResult()
            ;
    }
    /*
    public function findOneBySomeField($value): ?CaConge
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
