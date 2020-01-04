<?php


namespace App\Managers;


use App\Common\ObjectManager;
use App\Entity\Commande;
use App\Factory\CommandFactory;
use App\Factory\StatisticFactory;
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
        $commandProduits = $commande->getCommandProduits();
        if(is_null($commande->getId())) {
            foreach ($commandProduits as $commandProduit) {
                $qte = $commandProduit->getQte();
                $qteProduit = $commandProduit->getProduit()->getNbrBoiteProduite();
                $qteFinal = $qteProduit - $qte;
                if ($qteFinal <= 0) {
                    return [
                        'code' => 500,
                        'message' => "le stock est épuisé dans le produit " . $commandProduit->getProduit()->getName() . ": Ils sont restent $qteProduit"
                    ];
                } else {
                    $em = $this->objectManager->getEntityManager();
                    $oProduit = $commandProduit->getProduit();
                    $oProduit->setNbrBoiteProduite($qteFinal);
                    $em->persist($oProduit);
                    $em->flush();
                }
            }
        }
        $oCommand = $this->commandFactory->commandFactory($commande);
        $bReturn = $this->objectManager->saveObject($oCommand);
        return $bReturn;
    }

    public function findAll()
    {
        $em = $this->objectManager->getEntityManager();
        $oCommand = $em->getRepository(Commande::class)->findAll();
        return $oCommand;
    }

    public function getStatCommand()
    {
        $aData = [];
        $aReturn = [];
        $aoCommand = $this->objectManager->getEntityManager()->getRepository(Commande::class)->findAll();

        foreach ($aoCommand as $command) {
            $aoCommandProduit =  $command->getCommandProduits();
            foreach ($aoCommandProduit as $commandProduit) {
                $aData['nbr'] = $commandProduit->getQte();
                $day =$commandProduit->getCommand()->getCreatedAt()->format('D');
                $date =$commandProduit->getCommand()->getCreatedAt()->format('Y-m-d');
                $aData['day'] = $day;
                $aData['date'] = $date;
                $aReturn [] = $aData;
            }
        }
        $aResponse = StatisticFactory::formaterDataChart($aReturn);
        return $aResponse;
    }
}
