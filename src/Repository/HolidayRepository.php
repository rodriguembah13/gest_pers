<?php

namespace App\Repository;

use App\Entity\Holiday;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Holiday|null find($id, $lockMode = null, $lockVersion = null)
 * @method Holiday|null findOneBy(array $criteria, array $orderBy = null)
 * @method Holiday[]    findAll()
 * @method Holiday[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HolidayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Holiday::class);
    }

    // /**
    //  * @return Holiday[] Returns an array of Holiday objects
    //  */
    public function findByExampleField()
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.day BETWEEN :deb AND :fin')
            ->setParameter('deb', new \Datetime(date('Y').'-01-01'))
            ->setParameter('fin', new \Datetime(date('Y').'-12-31'))
            ->orderBy('h.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByBetweenDate($begin, $end)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.day BETWEEN :deb AND :fin')
            ->setParameter('deb', $begin)
            ->setParameter('fin', $end)
            ->orderBy('h.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function whereCurrentYear(QueryBuilder $qb)
    {
        $qb->andWhere('a.day BETWEEN :debut AND :fin')
                ->setParameter('debut', new \Datetime(date('Y').'-01-01'))
                ->setParameter('fin',
                    new \Datetime(date('Y').'-12-31'));
    }

    public function findOneBySomeField($value): ?Holiday
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function myFind()
    {
        $qb = $this->createQueryBuilder('a');
        $qb = $this->whereCurrentYear($qb);

        return $qb->getQuery()->getResult();
    }

    public function myFindAllDQL()
    {
        $query = $this->_em->createQuery('SELECT a FROM Holiday a');
        $resultats = $query->getResult();
    }
}
