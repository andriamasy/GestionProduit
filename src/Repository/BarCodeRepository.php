<?php

namespace App\Repository;

use App\Entity\BarCode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BarCode|null find($id, $lockMode = null, $lockVersion = null)
 * @method BarCode|null findOneBy(array $criteria, array $orderBy = null)
 * @method BarCode[]    findAll()
 * @method BarCode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BarCodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BarCode::class);
    }

    // /**
    //  * @return BarCode[] Returns an array of BarCode objects
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
    public function findOneBySomeField($value): ?BarCode
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
