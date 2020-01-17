<?php

namespace App\Repository;

use App\Entity\Rhlignereglepaie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Rhlignereglepaie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rhlignereglepaie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rhlignereglepaie[]    findAll()
 * @method Rhlignereglepaie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RhlignereglepaieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rhlignereglepaie::class);
    }

    // /**
    //  * @return Rhlignereglepaie[] Returns an array of Rhlignereglepaie objects
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
    public function findOneBySomeField($value): ?Rhlignereglepaie
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
