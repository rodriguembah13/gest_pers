<?php

namespace App\Repository;

use App\Entity\Departement;
use App\Entity\Presence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Presence|null find($id, $lockMode = null, $lockVersion = null)
 * @method Presence|null findOneBy(array $criteria, array $orderBy = null)
 * @method Presence[]    findAll()
 * @method Presence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PresenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Presence::class);
    }

    public function findByDepartement(Departement $departement)
    {
        return $this->createQueryBuilder('r')
            ->leftJoin('r.employe', 'employe')
            ->addSelect('employe')
            ->leftJoin('employe.departement', 'departement')
            ->andWhere('employe.departement = :dep')
            ->setParameter('dep', $departement)
            ->orderBy('employe.nomComplet', 'ASC')
            ->setMaxResults(100)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByDepartementAndJour($departement, $jour)
    {
        return $this->createQueryBuilder('r')
            ->leftJoin('r.employe', 'employe')
            ->addSelect('employe')
            ->leftJoin('employe.departement', 'departement')
            ->addSelect('departement')
            ->andWhere('departement.id = :dep')
            ->andWhere('r.dateCreation = :jour')
            ->setParameter('dep', $departement)
            ->setParameter('jour', $jour)
            ->orderBy('employe.nomComplet', 'ASC')
            ->setMaxResults(100)
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return Presence[] Returns an array of Presence objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Presence
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
