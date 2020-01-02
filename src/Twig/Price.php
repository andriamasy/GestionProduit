<?php


namespace App\Twig;


use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFunction;

class Price extends AbstractExtension implements GlobalsInterface
{
    public function getFunctions()
    {
        return [
            new TwigFunction('montant', [$this, 'getMontant']),
            new TwigFunction('montantTotal', [$this, 'getMontantTotal']),
            new TwigFunction('taxe', [$this, 'getTaxe']),
        ];
    }

    public function getMontant(float $prix , int $qte)
    {
        return $this->calculeMontant($prix,$qte);
    }

    public function getMontantTotal($commandProduit)
    {
        $montantTotal = 0;
        $montant = 0;
        foreach ($commandProduit as $value) {
            $montant = $this->calculeMontant($value->getQte(), $value->getProduit()->getCategory()->getPrix());
            $montantTotal += $montant;
        }
        return $montantTotal;
    }

    public function calculeMontant($prix, $qte)
    {
        return $prix * $qte;
    }

    public function getTaxe()
    {
        return 0;
    }

    /**
     * Returns a list of global variables to add to the existing list.
     *
     * @return array An array of global variables
     */
    public function getGlobals()
    {
        // TODO: Implement getGlobals() method.
        return [

        ];
    }
}
