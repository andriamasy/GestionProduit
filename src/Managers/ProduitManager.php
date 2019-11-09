<?php


namespace App\Managers;


use App\Common\ObjectManager;
use App\Entity\Produit;
use App\Factory\ProduitManagerStaticFactory;
use Doctrine\ORM\EntityManagerInterface;

class ProduitManager
{

    /**
     * @var ObjectManager
     */
    private $om;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * ProduitController constructor.
     * @param EntityManagerInterface $em
     * @param ObjectManager $om
     */
    public function __construct(EntityManagerInterface $em, ObjectManager $om)
    {
        $this->om = $om;
        $this->em = $em;
    }

    /**
     * Obtenir tous les produit
     */
    public function getAllProduct()
    {
        $oProduitRep = $this->em->getRepository(Produit::class);
        $aoProduit = $oProduitRep->findAll();
        return $aoProduit;
    }

    public function addProduct($_data)
    {
        $oData = $_data;
        $bReturn = $this->om->saveObject($oData);
        if($bReturn) {
            return true;
        } else {
            return false;
        }

    }

}
