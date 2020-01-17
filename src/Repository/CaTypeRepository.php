<?php

namespace App\Repository;

use App\Entity\CaType;
use App\Entity\Employe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CaType|null find($id, $lockMode = null, $lockVersion = null)
 * @method CaType|null findOneBy(array $criteria, array $orderBy = null)
 * @method CaType[]    findAll()
 * @method CaType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CaTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CaType::class);
    }

    public function findByEmployeField(Employe $employe)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.departement = :val')
            ->setParameter('val', $employe->getDepartement()->getId())
           ->andWhere('c.poste = :poste')
            ->setParameter('poste', $employe->getPoste()->getId())
            ->andWhere('c.entreprise = :entreprise')
            ->setParameter('entreprise', $employe->getDepartement()->getEntreprise()->getId())
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return CaType[] Returns an array of CaType objects
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

    /*
    public function findOneBySomeField($value): ?CaType
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
