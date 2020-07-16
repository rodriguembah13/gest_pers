<?php

namespace App\Repository;

use App\Entity\ExperienceEmploye;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ExperienceEmploye|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExperienceEmploye|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExperienceEmploye[]    findAll()
 * @method ExperienceEmploye[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExperienceEmployeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExperienceEmploye::class);
    }

    // /**
    //  * @return ExperienceEmploye[] Returns an array of ExperienceEmploye objects
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
    public function findOneBySomeField($value): ?ExperienceEmploye
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
