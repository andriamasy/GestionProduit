<?php

namespace App\Controller;

use App\Entity\LivraisonClient as LivraisonClientAlias;
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
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
        $aoLivraison = $this->livraisonManager->getAllLivraisonClient();
        if($request->query->get('query')) {
            $query = $request->query->get('query');
            //$aoProduit = $this->livraisonManager->search($query);
        }
        //dump($aoLivraison); die;
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
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
        $oLivraison = new LivraisonClientAlias();
        $form = $this->createForm(LivraisonType::class, $oLivraison);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $oData = $form->getData();
            $aReturn = $this->livraisonManager->addLivraisonClient($oData);
            if($aReturn['code'] === 200) {
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

    /**
     * @Route("/livraison/{id}", name="livraison_view", methods={"GET"})
     * @param LivraisonClientAlias $id
     * @param Request $request
     * @return Response
     */
    public function view(Request $request, LivraisonClientAlias $id)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
        $oLivraisonClient = $id;
        return $this->render('livraison/viewClient.html.twig', [
            'titre' => 'Detail Bon de Livraison',
            'bande' => 'Detail Bon de Livraison',
            'routeParent' => 'livraison',
            'routeNameParent' => 'Listes livraison client',
            'livraison' => $oLivraisonClient,
        ]);
    }
}
