<?php

namespace App\Repository;

use App\Entity\Employe;
use App\Entity\Project;
use App\Entity\Team;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findAll()
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }

    // /**
    //  * @return Project[] Returns an array of Project objects
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

    /**
    //  * @return Activity[] Returns an array of Activity objects
    //  */
    public function findByEmploye0(Team $team)
    {
        return $this->createQueryBuilder('a')
            ->leftJoin('a.teams', 'teams')
            ->addSelect('teams')
            ->leftJoin('teams.members', 'members')
            ->andWhere('customer = :val')
            ->setParameter('val', $team)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(1000)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByEmploye(Employe $employe)
    {
        $projects = [];

        foreach ($employe->getTeamsMembers() as $team) {
            foreach ($team->getProjects() as $project) {
                $projects[] = $project;
            }
        }

        return $projects;
    }

    /*
    public function findOneBySomeField($value): ?Project
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
