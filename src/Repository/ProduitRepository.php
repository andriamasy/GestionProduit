<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

    // /**
    //  * @return Produit[] Returns an array of Produit objects
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
    public function findOneBySomeField($value): ?Produit
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @param $_query
     * @return Query
     */
    public function search($_query)
    {
        $qb = $this->createQueryBuilder('p');
        $qb->join('p.category', 'c');
        $qb->andWhere($qb->expr()->like('p.name', $qb->expr()->literal('%'.$_query.'%')));
        $qb->orWhere($qb->expr()->like('p.reference', $qb->expr()->literal('%'.$_query.'%')));
        $qb->orWhere($qb->expr()->like('c.name', $qb->expr()->literal('%'.$_query.'%')));
        $qb->orWhere($qb->expr()->like('p.mesureBrix', $qb->expr()->literal('%'.$_query.'%')));
        $qb->orWhere($qb->expr()->like('p.mesureBrixFinal', $qb->expr()->literal('%'.$_query.'%')));
        $qb->orWhere($qb->expr()->like('p.nbrBoiteProduite', $qb->expr()->literal('%'.$_query.'%')));
        $qb->orWhere($qb->expr()->like('p.MesurrPHAvant', $qb->expr()->literal('%'.$_query.'%')));
        $qb->orWhere($qb->expr()->like('p.mesurePHApres', $qb->expr()->literal('%'.$_query.'%')));
        $qb->orWhere($qb->expr()->like('p.nombreTamissage', $qb->expr()->literal('%'.$_query.'%')));
        $qb->orWhere($qb->expr()->like('p.poidFinal', $qb->expr()->literal('%'.$_query.'%')));
        $qb->andWhere($qb->expr()->eq('p.isDelete', 0));
        $aReturn = $qb->getQuery();
        return $aReturn;
    }

    public function getAllProduit($_params)
    {
        $qb = $this->createQueryBuilder('p');
        $qb->andWhere($qb->expr()->eq('p.isDelete', ':isDelete'))
            ->setParameter('isDelete', $_params['isDelete']);
        return $qb->getQuery();
    }
}
