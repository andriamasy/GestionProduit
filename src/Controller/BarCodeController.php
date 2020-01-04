<?php

namespace App\Controller;

use App\Form\BarCodeType;
use App\Managers\BarCodeManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Zend\Barcode\Barcode;
use App\Entity\BarCode as CodeBar;

class BarCodeController extends AbstractController
{
    /**
     * @var BarCodeManager
     */
    private $barCodeManager;

    /**
     * BarCodeController constructor.
     * @param BarCodeManager $barCodeManager
     */
    public function __construct(BarCodeManager $barCodeManager)
    {

        $this->barCodeManager = $barCodeManager;
    }

    /**
     * @Route("/bar/code", name="bar_code")
     */
    public function index()
    {
        $oBarCode = $this->barCodeManager->getAll();
        return $this->render('bar_code/index.html.twig', [
           'titre' => 'Code Barre ',
           'bande' => 'Code Barre ',
            'barCodes' => $oBarCode,
        ]);
    }

    function generateEAN($number)
    {
        $code = '300' . str_pad($number, 9, '0');
        $weightflag = true;
        $sum = 0;
        // Weight for a digit in the checksum is 3, 1, 3.. starting from the last digit.
        // loop backwards to make the loop length-agnostic. The same basic functionality
        // will work for codes of different lengths.
        for ($i = strlen($code) - 1; $i >= 0; $i--)
        {
            $sum += (int)$code[$i] * ($weightflag?3:1);
            $weightflag = !$weightflag;
        }
        $code .= (10 - ($sum % 10)) % 10;
        return $code;
    }

    public function barcode()
    {
        $numberCode =  $this->generateEAN(0001);
        $code = substr_replace($numberCode ,"",-1);
        Barcode::render(
            'ean13',
            'image',
            [
                'text' => $code,
                'font' => 4,
                'barHeight' => 150,
                'barThinWidth' => 3,
            ]
        );
    }

    /**
     * @Route("/barCode/add", name="barCode_add", methods={"POST", "GET"})
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function createBarCode(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
        $oCodeBar = new CodeBar();
        $form = $this->createForm(BarCodeType::class, $oCodeBar);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $bReturn = $this->barCodeManager->saveBarCode($oCodeBar);
            if($bReturn['code'] === 200) {
                return $this->redirectToRoute('bar_code');
            }
        }
        return $this->render('bar_code/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
