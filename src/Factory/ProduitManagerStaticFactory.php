<?php


namespace App\Factory;


use App\Entity\Produit;

class ProduitManagerStaticFactory
{
    public static function produitFactory(Produit $_produit)
    {
        $oProduit = $_produit;
        if(key_exists($_data['nom'], $_data)) {
            $oProduit->setName($_data['nom']);
        }
        if(key_exists($_data['reference'], $_data)) {
            $oProduit->setReference($_data['reference']);
        }
        dump($oProduit); die;
    }

}
