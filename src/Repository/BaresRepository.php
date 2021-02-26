<?php

namespace App\Repository;

use App\Entity\Bares;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bares|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bares|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bares[]    findAll()
 * @method Bares[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BaresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bares::class);
    }

    // /**
    //  * @return Bares[] Returns an array of Bares objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bares
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
