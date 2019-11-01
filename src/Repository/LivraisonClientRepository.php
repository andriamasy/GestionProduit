<?php

namespace App\Repository;

use App\Entity\LivraisonClient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LivraisonClient|null find($id, $lockMode = null, $lockVersion = null)
 * @method LivraisonClient|null findOneBy(array $criteria, array $orderBy = null)
 * @method LivraisonClient[]    findAll()
 * @method LivraisonClient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivraisonClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LivraisonClient::class);
    }

    // /**
    //  * @return LivraisonClient[] Returns an array of LivraisonClient objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LivraisonClient
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
