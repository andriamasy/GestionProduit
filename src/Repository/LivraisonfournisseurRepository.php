<?php

namespace App\Repository;

use App\Entity\Livraisonfournisseur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Livraisonfournisseur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livraisonfournisseur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livraisonfournisseur[]    findAll()
 * @method Livraisonfournisseur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivraisonfournisseurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livraisonfournisseur::class);
    }

    // /**
    //  * @return Livraisonfournisseur[] Returns an array of Livraisonfournisseur objects
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
    public function findOneBySomeField($value): ?Livraisonfournisseur
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
