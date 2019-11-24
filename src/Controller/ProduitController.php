<?php

namespace App\Controller;

use App\Common\ObjectManager;
use App\Entity\Produit;
use App\Factory\ProduitManagerStaticFactory;
use App\Form\Type\ProduitType;
use App\Managers\PrintManager;
use App\Managers\ProduitManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ProduitController extends AbstractController
{
    private $pm;
    private $objectManager;

    public function __construct(ProduitManager $pm, ObjectManager $objectManager)
    {
        $this->pm = $pm;
        $this->objectManager = $objectManager;
    }

    /**
     * @Route("/produit", name="produit", methods={"GET"}, options = { "expose" = true })
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $aoProduit = $this->pm->getAllProduct();
        if($request->query->get('query')) {
            $query = $request->query->get('query');
            $aoProduit = $this->pm->search($query);
        }


        $pagination = $paginator->paginate(
            $aoProduit, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );
        return $this->render('produit/index.html.twig', [
            'titre' => 'Produits',
            'bande' => 'Produits',
            'produits' => $pagination,
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
    public function viewProduct(Request $request, Produit $id )
    {
        $oProduit = $id;
        return $this->render('produit/view.html.twig',[
            'titre' => 'Detail Produit',
            'bande' => 'detail produit',
            'routeParent' => 'produit',
            'routeNameParent' => 'Listes Produits',
            'produit' => $oProduit,
        ]);
    }

    /**
     * @Route("api/produit/{id}",
     *     name="api_produit_view",
     *     methods={"GET"},
     *     options = { "expose" = true }
     *     )
     * @param Produit $id
     * @param PrintManager $printManager
     * @return JsonResponse
     */
    public function apiProduitView(Produit $id, PrintManager $printManager)
    {
        $oProduit = $id;
        $aReturn =  $printManager->getPrint($oProduit);
        return new JsonResponse($aReturn);
    }

    /**
     * @Route(
     *     "produit/edit/{id}",
     *     name="produit_edit",
     *     methods={"GET", "POST"},
     *     options = { "expose" = true }
     *     )
     * @param Produit $id
     * @param Request $request
     * @return Response
     */
    public function edit(Produit $id, Request $request)
    {
        $oProduit = $id;
        $form = $this->createForm(ProduitType::class, $oProduit);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->objectManager->saveObject($oProduit);
            return $this->redirectToRoute('produit');
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
     * @Route(
     *     "produit/delete/{id}",
     *     name="produit_delete",
     *     methods={"DELETE"},
     *     options={"expose" = true}
     * )
     * @param Produit $id
     * @return JsonResponse
     */
    public function delete(Produit $id)
    {
        $oProduit = $id;
        $aResponse = $this->pm->delete($oProduit);
        return new JsonResponse($aResponse);
    }
}
