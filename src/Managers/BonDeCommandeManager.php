<?php


namespace App\Managers;


use App\Common\ObjectManager;
use App\Entity\Commande;

class BonDeCommandeManager
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * BonDeCommandeManager constructor.
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function getAllCommaand()
    {
        $em = $this->objectManager->getEntityManager();
        $aoCommand = $em->getRepository(Commande::class)->getAll();
        return $aoCommand;
    }
}
