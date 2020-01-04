<?php


namespace App\Managers;


use App\Common\ObjectManager;
use App\Entity\LivraisonClient;

class LivraisonManager
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * Livraison constructor.
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager)
    {

        $this->objectManager = $objectManager;
    }

    public function getAllLivraisonClient()
    {
        $oLivraison = $this->objectManager->getEntityManager()
            ->getRepository(LivraisonClient::class)->getAll();
        return $oLivraison;
    }

    public function addLivraisonClient(LivraisonClient $livraisonClient)
    {
       return $this->objectManager->saveObject($livraisonClient);
    }

    public function findAllLivraisonClient()
    {
        $oLivraison = $this->objectManager->getEntityManager()
            ->getRepository(LivraisonClient::class)->findAll();
        return $oLivraison;
    }
}
