<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DasboardController extends AbstractController
{
    /**
     * @Route("/", name="dasboard", methods={"GET"})
     */
    public function index()
    {
        return $this->render('dasboard/index.html.twig', [
            'controller_name' => 'DasboardController',
        ]);
    }
}
