<?php

namespace App\Repository;

use App\Entity\RhBulletinPaie;
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
      @return Rhlignereglepaie[] Returns an array of Rhlignereglepaie objects

      */
    public function findByBulletinorderBySequence(RhBulletinPaie $bulletinPaie)
    {
        return $this->createQueryBuilder('r')
            ->leftJoin('r.rhreglesalaire', 'rh')
            ->addSelect('rh')
            ->andWhere('r.rhBulletinPaie = :val')
            ->setParameter('val', $bulletinPaie)
            ->orderBy('rh.sequencecalcul', 'ASC')
            ->setMaxResults(100)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByBulletinorderByCat(RhBulletinPaie $bulletinPaie, $code)
    {
        return $this->createQueryBuilder('r')
            ->leftJoin('r.rhreglesalaire', 'rh')
            ->addSelect('rh')
            ->leftJoin('rh.rhcategorieregle', 'rhc')
            ->andWhere('rhc.code = :code')
            ->andWhere('r.rhBulletinPaie = :val')
            ->setParameter('val', $bulletinPaie)
            ->setParameter('code', $code)
            ->orderBy('rh.sequencecalcul', 'ASC')
            ->setMaxResults(100)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByBulletinorderByCategorieRegle(RhBulletinPaie $bulletinPaie, $code)
    {
        return $this->createQueryBuilder('r')
            ->leftJoin('r.rhreglesalaire', 'rh')
            ->addSelect('rh')
            ->andWhere('rh.code = :code')
            ->andWhere('r.rhBulletinPaie = :val')
            ->setParameter('val', $bulletinPaie)
            ->setParameter('code', $code)
            ->orderBy('rh.sequencecalcul', 'ASC')
            ->setMaxResults(100)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByBulletinIsRegleVisible(RhBulletinPaie $bulletinPaie)
    {
        return $this->createQueryBuilder('r')
            ->leftJoin('r.rhreglesalaire', 'rh')
            ->addSelect('rh')
            ->andWhere('rh.isvisible = :code')
            ->andWhere('r.rhBulletinPaie = :val')
            ->setParameter('val', $bulletinPaie)
            ->setParameter('code', true)
            ->orderBy('rh.sequencecalcul', 'ASC')
            ->setMaxResults(100)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findOneByBulletinorderByCat(RhBulletinPaie $bulletinPaie, $code)
    {
        return $this->createQueryBuilder('r')
            ->leftJoin('r.rhreglesalaire', 'rh')
            ->addSelect('rh')
            ->andWhere('rh.code = :code')
            ->andWhere('r.rhBulletinPaie = :val')
            ->setParameter('val', $bulletinPaie)
            ->setParameter('code', $code)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

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
