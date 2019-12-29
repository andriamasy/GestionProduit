<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\CommandProduit;
use App\Form\CommandType;
use App\Managers\BonDeCommandeManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BonDeCommandeController extends AbstractController
{
    /**
     * @var BonDeCommandeManager
     */
    private $commandeManager;

    public function __construct(BonDeCommandeManager $commandeManager)
    {
        $this->commandeManager = $commandeManager;
    }

    /**
     * @Route("/commande", name="bon_de_commande")
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $aoCommand = $this->commandeManager->getAllCommaand();
        $pagination = $paginator->paginate(
            $aoCommand, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );
        return $this->render('bon_de_commande/index.html.twig', [
            'titre' => 'Listes Bon de Commande',
            'bande' => 'Listes Bon de Commande',
            'commandes' => $pagination,
        ]);
    }

    /**
     * @Route("/commande/ajouter", name="command_add", methods={"POST", "GET"})
     * @param Request $request
     * @return Response
     */
    public function addCommand(Request $request)
    {
        $oCommand = new Commande();
        $form = $this->createForm(CommandType::class, $oCommand);
        $form->handleRequest($request);
       // dump($oCommand); die;
        if($form->isSubmitted() && $form->isValid()) {
            dump($oCommand);
            $bResponse = $this->commandeManager->save($oCommand);
            if($bResponse) {
                return $this->redirectToRoute('bon_de_commande');
            } else {
                $this->addFlash('error', 'Enregistrement n\'est pas effectué correctement');
            }
        }
        return $this->render('bon_de_commande/add.html.twig', [
            'form' => $form->createView(),
            'titre' => 'Ajouter Bon de Commande',
            'bande' => 'Ajouter Bon de Commande',
            'routeParent' => 'bon_de_commande',
            'routeNameParent' => 'Listes des bon commandes',
        ]);
    }

    /**
     * @Route("/command/edit/{id}", name="command_edit", methods={"GET", "POST"})
     * @param Request $request
     * @param Commande $id
     * @return Response
     */
    public function edit(Request $request, Commande $id)
    {
        $oCommand = $id;
        $form = $this->createForm(CommandType::class, $oCommand);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $bResponse = $this->commandeManager->save($oCommand);
            if($bResponse) {
                return $this->redirectToRoute('bon_de_commande');
            }
        }
        return $this->render('bon_de_commande/add.html.twig', [
            'form' => $form->createView(),
            'titre' => 'Edit Bon de Commande',
            'bande' => 'Edit Bon de Commande',
            'routeParent' => 'bon_de_commande',
            'routeNameParent' => 'Listes des bon commandes',
        ]);
    }

    /**
     * @Route("/command/view/{id}", name="command_view", methods={"GET"})
     * @param Commande $id
     * @return Response
     */
    public function view(Commande $id)
    {
        $oCommand = $id;
        return $this->render('bon_de_commande/view.html.twig',[
                'command' => $oCommand,
                'titre' => 'Detail Bon de Commande',
                'bande' => 'Detail Bon de Commande',
                'routeParent' => 'bon_de_commande',
                'routeNameParent' => 'Listes des bon commandes',
            ]);
    }
}
