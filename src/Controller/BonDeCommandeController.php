<?php

namespace App\Controller;

use App\Entity\Commande;
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
            'titre' => 'Liste Bon de Commande',
            'bande' => 'Liste Bon de Commande',
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
        return $this->render('bon_de_commande/add.html.twig', [
            'form' => $form->createView(),
            'titre' => 'Ajouter Bon de Commande',
            'bande' => 'Ajouter Bon de Commande',
            'routeParent' => 'bon_de_commande',
            'routeNameParent' => 'Listes des bon commandes',
        ]);
    }
}
