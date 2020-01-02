<?php

namespace App\Controller;

use App\Entity\LivraisonClient;
use App\Form\LivraisonType;
use App\Managers\LivraisonManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivraisonController extends AbstractController
{
    /**
     * @var LivraisonManager
     */
    private $livraisonManager;

    /**
     * LivraisonController constructor.
     * @param LivraisonManager $livraisonManager
     */
    public function __construct(LivraisonManager $livraisonManager)
    {

        $this->livraisonManager = $livraisonManager;
    }

    /**
     * @Route("/livraison", name="livraison")
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $aoLivraison = $this->livraisonManager->getAllLivraisonClient();
        if($request->query->get('query')) {
            $query = $request->query->get('query');
            //$aoProduit = $this->livraisonManager->search($query);
        }


        $pagination = $paginator->paginate(
            $aoLivraison, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );
        return $this->render('livraison/index.html.twig', [
            'titre' => 'Bon de Livraison',
            'bande' => 'Liste Bon de livraison',
            'livraisons' => $pagination,
        ]);
    }

    /**
     * @Route("/livraison/client/add", name="livraison_client_add", methods={"POST", "GET"})
     * @param Request $request
     * @return Response
     */
    public function addLivraisonClient(Request $request)
    {
        $oLivraison = new LivraisonClient();
        $form = $this->createForm(LivraisonType::class, $oLivraison);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $oData = $form->getData();
            $bReturn = $this->livraisonManager->addLivraisonClient($oData);
            if($bReturn) {
                $this->addFlash('success', 'Ajout Bon de Livraison avec Succèss');
                return $this->redirectToRoute('livraison');

            }
        }

        return $this->render('livraison/addClient.html.twig', [
            'form' => $form->createView(),
            'titre' => 'Ajouter Bon de Livraison',
            'bande' => 'Ajouter Bon de Livraison',
            'routeParent' => 'livraison',
            'routeNameParent' => 'Listes livraison client',
        ]);
    }
}
