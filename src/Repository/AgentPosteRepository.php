<?php

namespace App\Repository;

use App\Entity\AgentPoste;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AgentPoste|null find($id, $lockMode = null, $lockVersion = null)
 * @method AgentPoste|null findOneBy(array $criteria, array $orderBy = null)
 * @method AgentPoste[]    findAll()
 * @method AgentPoste[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgentPosteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AgentPoste::class);
    }

    // /**
    //  * @return AgentPoste[] Returns an array of AgentPoste objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AgentPoste
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
