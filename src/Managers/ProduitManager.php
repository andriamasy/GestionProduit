<?php


namespace App\Managers;


use App\Entity\Produit;
use App\Factory\ProduitManagerStaticFactory;
use Doctrine\ORM\EntityManagerInterface;

class ProduitManager
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * ProduitController constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
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
        $oProduitFactory = new ProduitManagerStaticFactory();
        $oProduct = $oProduitFactory::createNewFactoryProduit($oData);
        dump($oProduct); die;
    }

}
