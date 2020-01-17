<?php

namespace App\Repository;

use App\Entity\RhBulletinPaie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RhBulletinPaie|null find($id, $lockMode = null, $lockVersion = null)
 * @method RhBulletinPaie|null findOneBy(array $criteria, array $orderBy = null)
 * @method RhBulletinPaie[]    findAll()
 * @method RhBulletinPaie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RhBulletinPaieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RhBulletinPaie::class);
    }

    // /**
    //  * @return RhBulletinPaie[] Returns an array of RhBulletinPaie objects
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
    public function findOneBySomeField($value): ?RhBulletinPaie
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
