<?php

namespace App\Repository;

use App\Entity\EtudeEmploye;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EtudeEmploye|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtudeEmploye|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtudeEmploye[]    findAll()
 * @method EtudeEmploye[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudeEmployeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtudeEmploye::class);
    }

    // /**
    //  * @return EtudeEmploye[] Returns an array of EtudeEmploye objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EtudeEmploye
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
