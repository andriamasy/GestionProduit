<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ClientType;
use App\Form\UserType;
use App\Managers\UserManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @var UserManager
     */
    private $userManager;

    /**
     * UserController constructor.
     * @param UserManager $userManager
     */
    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @Route("/users", name="user")
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
        $aoUsers = $this->userManager->getUserByRole('_ADMIN');
        $pagination = $paginator->paginate(
            $aoUsers, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'users' => $pagination
        ]);
    }

    /**
     * @Route("/user/add", name="user_add", methods={"POST", "GET"})
     * @param Request $request
     * @return Response
     */
    public function addUser(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
        $oUser = new User();
        $form = $this->createForm(UserType::class, $oUser);
        return $this->render('user/add.html.twig', [
            'form' => $form->createView(),
            'titre' => 'Ajouter Utilisateur',
            'bande' => 'Ajouter Utilisateur',
            'routeParent' => 'user',
            'routeNameParent' => 'Listes Utilisateur',
        ]);
    }

    /**
     * =========================================================================
     *                      PARTIE CLIENT
     * =========================================================================
     */

    /**
     * @Route("/clients", name="client", methods={"GET"})
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function client(Request $request, PaginatorInterface $paginator)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
        $aoUsers = $this->userManager->getUserByRole('_CUSTOMER');
        $pagination = $paginator->paginate(
            $aoUsers, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );
        return $this->render('user/client.html.twig', [
            'controller_name' => 'UserController',
            'users' => $pagination
        ]);

    }

    /**
     * @Route("/user/add/client", name="user_add_client", methods={"GET", "POST"})
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    public function addClient(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
        $oUser = new User();
        $form = $this->createForm(ClientType::class, $oUser);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()  ) {
            $oUser->setPassword($passwordEncoder->encodePassword(
                $oUser,
                '123456'
            ));
            $oUser->setRoles(['ROLE_CUSTOMER']);
            $oUser->setUsername($oUser->getEmail());
            $this->userManager->saveUser($oUser);
            return $this->redirectToRoute('client');
        }

        return $this->render('user/addClient.html.twig', [
            'form' => $form->createView(),
            'titre' => 'Edit Client',
            'bande' => 'Edit Client',
            'routeParent' => 'client',
            'routeNameParent' => 'Listes Clients',
        ]);
    }

    /**
     * @Route("/client/edit/{id}", name="user_client_edit", methods={"POST", "GET"})
     * @param Request $request
     * @param User $id
     * @return Response
     */
    public function editClient(Request $request, User $id)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
        $oUser = $id;
        $form = $this->createForm(ClientType::class, $oUser);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->userManager->saveUser($oUser);
            return $this->redirectToRoute('client');
        }
        return $this->render('user/addClient.html.twig', [
            'form' => $form->createView(),
            'titre' => 'Edit Client',
            'bande' => 'Edit Client',
            'routeParent' => 'client',
            'routeNameParent' => 'Listes Clients',
        ]);
    }
}
