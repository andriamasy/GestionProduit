<?php

namespace App\Repository;

use App\Entity\FicheDeVente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FicheDeVente|null find($id, $lockMode = null, $lockVersion = null)
 * @method FicheDeVente|null findOneBy(array $criteria, array $orderBy = null)
 * @method FicheDeVente[]    findAll()
 * @method FicheDeVente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FicheDeVenteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FicheDeVente::class);
    }

    // /**
    //  * @return FicheDeVente[] Returns an array of FicheDeVente objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FicheDeVente
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
