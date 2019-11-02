<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\Type\ProduitType;
use App\Managers\ProduitManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    private $pm;

    public function __construct(ProduitManager $pm)
    {
        $this->pm = $pm;
    }

    /**
     * @Route("/produit", name="produit")
     */
    public function index()
    {
        $aoProduit = $this->pm->getAllProduct();
        return $this->render('produit/index.html.twig', [
            'titre' => 'Produits',
            'bande' => 'Produits',
            'produits' => $aoProduit,
        ]);
    }

    /**
     * @Route("/produit/ajouter", name="produit_add", methods={"POST","GET"})
     * @param Request $request
     */
    public function addProduct(Request $request)
    {
        $oProduit = new Produit();
        $form = $this->createForm(ProduitType::class, $oProduit);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $oData = $form->getData();
            $this->pm->addProduct($oData);
        }

        return $this->render('produit/add.html.twig', [
            'form' => $form->createView(),
            'titre' => 'Ajouter Produits',
            'bande' => 'Produit',
        ]);
    }
}
