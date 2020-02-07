<?php

namespace App\Repository;

use App\Entity\AdvanceSalaire;
use App\Entity\Employe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AdvanceSalaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdvanceSalaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdvanceSalaire[]    findAll()
 * @method AdvanceSalaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvanceSalaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdvanceSalaire::class);
    }

    // /**
    //  * @return AdvanceSalaire[] Returns an array of AdvanceSalaire objects
    //  */

    public function findByEmployeField(Employe $employe)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.employe = :val')
            ->andWhere('a.status = : sta')
            ->setParameter('val', $employe)
            ->setParameter('sta', false)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?AdvanceSalaire
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
