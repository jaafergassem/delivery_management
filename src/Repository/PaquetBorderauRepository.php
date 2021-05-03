<?php

namespace App\Repository;

use App\Entity\PaquetBorderau;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PaquetBorderau|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaquetBorderau|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaquetBorderau[]    findAll()
 * @method PaquetBorderau[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaquetBorderauRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaquetBorderau::class);
    }

    // /**
    //  * @return PaquetBorderau[] Returns an array of PaquetBorderau objects
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
    public function findOneBySomeField($value): ?PaquetBorderau
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
