<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategorieType;
use App\Managers\CategoriesManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{

    /**
     * @var CategoriesManager
     */
    private $categoriesManager;

    public function __construct(CategoriesManager $categoriesManager)
    {
        $this->categoriesManager = $categoriesManager;
    }

    /**
     * @Route("/categorie", name="categorie")
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $aoCategories = $this->categoriesManager->getAllCategorie();
        $pagination = $paginator->paginate(
            $aoCategories, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
            'categories' => $pagination
        ]);
    }

    /**
     * @Route("/categorie/ajouter", name="category_add", methods={"GET", "POST"})
     * @param Request $request
     * @return Response
     */
    public function addCategorie(Request $request)
    {
        $oCategory = new Category();
        $form = $this->createForm(CategorieType::class, $oCategory);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $bReturn = $this->categoriesManager->saveCategorie($oCategory);
            if($bReturn) {
                return $this->redirectToRoute('categorie');
            }
        }
        return $this->render('categorie/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/category/isActivated",
     *     name="category_isActivated",
     *     options={"expose" = true },
     *     methods={"POST"}
     *     )
     * @param Request $request
     * @return JsonResponse
     */
    public function isActivated(Request $request)
    {
        $isActivated = $request->request->get('isActivated');
        $id = $request->request->get('id');
        if($isActivated === "true") {
            $isActivated = true;
        }
        if($isActivated === "false") {
            $isActivated = false;
        }
        $aData = [
            'id' => $id,
            'isActivated' => $isActivated,
        ];
        $aResponse = $this->categoriesManager->isActivated($aData);
        return new JsonResponse($aResponse);
    }

    /**
     * @Route("/category/edit/{id}", name="category_edit", options={"expose": true}, methods={"POST", "GET"})
     * @param Request $request
     * @param Category $id
     * @return Response
     */
    public function editCategory(Request $request, Category $id)
    {
        $oCategory = $id;
        $form = $this->createForm(CategorieType::class, $oCategory);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $bReturn = $this->categoriesManager->saveCategorie($oCategory);
            if($bReturn) {
                return $this->redirectToRoute('categorie');
            }
        }
        return $this->render('categorie/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/categorie/{id}", name="category_view", methods={"GET"})
     * @param Request $request
     * @param Category $id
     * @return Response
     */
    public function view(Request $request, Category $id)
    {
        $oCategory = $id;
        return $this->render('categorie/view.html.twig',[
            'titre' => 'Detail categorie',
            'bande' => 'Detail categorie',
            'routeParent' => 'categorie',
            'routeNameParent' => 'Listes Categorie',
            'produit' => $oCategory,
        ]);
    }

    /**
     * @Route("/categorie/{id}", name="category_delete", methods={"DELETE"}, options={"expose": true})
     * @param Request $request
     * @param Category $id
     * @return JsonResponse
     */
    public function deleteCategory(Request $request, Category $id)
    {
        $oCategory = $id;
        $aReturn = $this->categoriesManager->delete($oCategory);
        return new JsonResponse($aReturn);
    }
}
