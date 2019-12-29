<?php


namespace App\Managers;


use App\Common\ObjectManager;
use App\Entity\Commande;
use App\Entity\CommandProduit;
use App\Factory\CommandFactory;
use Doctrine\ORM\Query;

class BonDeCommandeManager
{
    /**
     * @var ObjectManager
     */
    private $objectManager;
    /**
     * @var CommandFactory
     */
    private $commandFactory;

    /**
     * BonDeCommandeManager constructor.
     * @param ObjectManager $objectManager
     * @param CommandFactory $commandFactory
     */
    public function __construct(ObjectManager $objectManager, CommandFactory $commandFactory)
    {
        $this->objectManager = $objectManager;
        $this->commandFactory = $commandFactory;
    }

    /**
     * @return Query
     */
    public function getAllCommaand()
    {
        $em = $this->objectManager->getEntityManager();
        $aoCommand = $em->getRepository(Commande::class)->getAll();
        return $aoCommand;
    }

    public function save(Commande $commande)
    {
       $oCommand = $this->commandFactory->commandFactory($commande);
        $bReturn = $this->objectManager->saveObject($oCommand);
        return $bReturn;
    }
}
