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
        $em = $this->objectManager->getEntityManager();
        $oLivraison = $em->getRepository('App:LivraisonClient')->getAll();
        return $oLivraison;
    }

    public function addLivraisonClient(LivraisonClient $livraisonClient)
    {
        dump($livraisonClient); die;
    }
}
