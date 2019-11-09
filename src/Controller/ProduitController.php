<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\Type\ProduitType;
use App\Managers\ProduitManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
     * @return RedirectResponse|Response
     */
    public function addProduct(Request $request)
    {
        $oProduit = new Produit();
        $form = $this->createForm(ProduitType::class, $oProduit);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $oData = $form->getData();
            $bReturn = $this->pm->addProduct($oData);
            if($bReturn) {
                $this->addFlash('success', 'Ajout Produit avec Succèss');
                return $this->redirectToRoute('produit');

            }
        }

        return $this->render('produit/add.html.twig', [
            'form' => $form->createView(),
            'titre' => 'Ajouter Produits',
            'bande' => 'Ajouter Produit',
            'routeParent' => 'produit',
            'routeNameParent' => 'Listes Produits',
        ]);
    }

    /**
     * @Route("produit/{id}", name="produit_view", methods={"GET"})
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function viewProduct(Request $request, Produit $id ) {
        $oProduit = $id;
        return $this->render('produit/view.html.twig',[
            'titre' => 'Detail Produit',
            'bande' => 'detail produit',
            'routeParent' => 'produit',
            'routeNameParent' => 'Listes Produits',
            'produit' => $oProduit,
        ]);
    }
}
