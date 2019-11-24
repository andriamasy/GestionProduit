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
        $aoProduit = $oProduitRep->getAllProduit([
            'isDelete' => 0
        ]);
        return $aoProduit;
    }

    public function addProduct($_data)
    {
        $oData = $_data;
        $bReturn = $this->om->saveObject($oData);
        return $bReturn;
    }

    public function delete(Produit $_produit) {
        $oProduit = $_produit;
        $aResponse = [];
        if (!empty($oProduit) && is_object($oProduit)) {
            $oProduit->setIsDelete(true);
            $this->om->saveObject($oProduit);
            $aResponse['error'] = false;
            $aResponse['message'] ="Suppression est avec success ";
            $aResponse['code'] = 200;
        } else {
            $aResponse['error'] = true;
            $aResponse['message'] ="Echec suppression";
            $aResponse['code'] = 500;
        }
        return $aResponse;
    }

    public function search($_query)
    {
        $query = $_query;
        $aoProduit = $this->em->getRepository(Produit::class)->search($query);
        return $aoProduit;
    }

}
