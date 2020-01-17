<?php

namespace App\Repository;

use App\Entity\RhCategorieRegle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RhCategorieRegle|null find($id, $lockMode = null, $lockVersion = null)
 * @method RhCategorieRegle|null findOneBy(array $criteria, array $orderBy = null)
 * @method RhCategorieRegle[]    findAll()
 * @method RhCategorieRegle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RhCathegorieRegleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RhCategorieRegle::class);
    }

    // /**
    //  * @return RhCategorieRegle[] Returns an array of RhCategorieRegle objects
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
    public function findOneBySomeField($value): ?RhCategorieRegle
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
