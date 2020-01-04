<?php

namespace App\Controller;

use App\Managers\BonDeCommandeManager;
use App\Managers\LivraisonManager;
use App\Managers\ProduitManager;
use App\Managers\UserManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DasboardController extends AbstractController
{

    /**
     * @var BonDeCommandeManager
     */
    private $commandeManager;
    /**
     * @var LivraisonManager
     */
    private $livraisonManager;
    /**
     * @var UserManager
     */
    private $userManager;
    /**
     * @var ProduitManager
     */
    private $produitManager;

    public function __construct(
        BonDeCommandeManager $commandeManager,
        LivraisonManager $livraisonManager,
        UserManager $userManager,
        ProduitManager $produitManager
    )
    {

        $this->commandeManager = $commandeManager;
        $this->livraisonManager = $livraisonManager;
        $this->userManager = $userManager;
        $this->produitManager = $produitManager;
    }

    /**
     * @Route("/", name="dasboard", methods={"GET"})
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {

        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
        $cpu = $this->get_server_cpu_usage();

        $oCommand = $this->commandeManager->findAll();
        $oLivraison = $this->livraisonManager->findAllLivraisonClient();
        $oClient = $this->userManager->findClient();

        $aoProduit = $this->produitManager->getAllProduct();
        $iProduitCountWeek = $this->produitManager->getSommeProduitWeek();
        $percentProduit = $this->produitManager->getPercentProduit();

        $produits = $paginator->paginate(
            $aoProduit, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            4 /*limit per page*/
        );

        return $this->render('dasboard/index.html.twig', [
            'cpu' => $cpu,
            'titre' => "Tableau de Board",
            'bande' => "Dasboard",
            'commandes' => $oCommand,
            'livrisonClients' => $oLivraison,
            'userClients' => $oClient,
            'produits' => $produits,
            'produitsSommeWeek' => $iProduitCountWeek,
            'percentProduut' => $percentProduit,
        ]);
    }

    function get_server_cpu_usage()
    {
        $load = null;
        if (stristr(PHP_OS, "win")) {
            $cmd = "wmic cpu get loadpercentage /all ";
            @exec($cmd, $output);
            if ($output) {
                foreach ($output as $line)
                {
                    if ($line && preg_match("/^[0-9]+\$/", $line))
                    {
                        $load = $line;
                        break;
                    }
                }
            }
        } else {
            $sys_load = sys_getloadavg();
            $load = $sys_load[0];
        }
        return (int) $load;
    }

}
