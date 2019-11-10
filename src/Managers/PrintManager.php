<?php


namespace App\Managers;


use App\Entity\Produit;

class PrintManager
{
    public function getPrint(Produit $_data)
    {
        $aResponse = [];
        $tmp = [];
        $aResponse['Nom'] = "Date";
        $aResponse['Valeur'] = $_data->getCreatedAt()->format('d/m/Y');
        $tmp[] = $aResponse;
        $aResponse['Nom'] = "Production";
        $aResponse['Valeur'] = $_data->getCategory()->getName();
        $tmp[] = $aResponse;
        $aResponse['Nom'] = "Reference";
        $aResponse['Valeur'] = $_data->getReference();
        $tmp[] = $aResponse;
        $aResponse['Nom'] = "Poids des Fruits achetés [kg]";
        $aResponse['Valeur'] = $_data->getPoidDufruitAcheter();
        $tmp[] = $aResponse;
        $aResponse['Nom'] = "Poids des Fruits épluchés [kg]";
        $aResponse['Valeur'] = $_data->getPoidDufruitepluches();
        $tmp[] = $aResponse;
        $aResponse['Nom'] = "Passage Raffineuse";
        $aResponse['Valeur'] = $_data->getPassageRaffiner();
        $tmp[] = $aResponse;
        $aResponse['Nom'] = "Nombre de Tamisage";
        $aResponse['Valeur'] = $_data->getNombreTamissage();
        $tmp[] = $aResponse;
        $aResponse['Nom'] = "Poids des Fruits Tamissée [kg]";
        $aResponse['Valeur'] = $_data->getPoidDuFruitTamisse();
        $tmp[] = $aResponse;
        $aResponse['Nom'] = "Passage Emuisionneuse";
        $aResponse['Valeur'] = $_data->getPassageEmissionneuse();
        $tmp[] = $aResponse;
        $aResponse['Nom'] = "Quantité d'eau Ajoutée [litres]";
        $aResponse['Valeur'] = $_data->getQteEau();
        $tmp[] = $aResponse;
        $aResponse['Nom'] = "Poids Final [Kg]";
        $aResponse['Valeur'] = $_data->getPoidFinal();
        $tmp[] = $aResponse;
        $aResponse['Nom'] = "Mesure du PH Avant Traitement Acide Citrique";
        $aResponse['Valeur'] = $_data->getMesurrPHAvant();
        $tmp[] = $aResponse;
        $aResponse['Nom'] = "Quantité d'acide citrique rajouter [gr]";
        $aResponse['Valeur'] = $_data->getQteAcide();
        $tmp[] = $aResponse;
        $aResponse['Nom'] = "Nouvelle Mesure du PH Après Traitement Acide";
        $aResponse['Valeur'] = $_data->getMesurePHApres();
        $tmp[] = $aResponse;
        $aResponse['Nom'] = "Mesure du Brix";
        $aResponse['Valeur'] = $_data->getMesureBrix();
        $tmp[] = $aResponse;
        $aResponse['Nom'] = "Quantité Sucre Ajouté [Kg]";
        $aResponse['Valeur'] = $_data->getQteSucre();
        $tmp[] = $aResponse;
        $aResponse['Nom'] = "Mesure du Brix Final";
        $aResponse['Valeur'] = $_data->getMesureBrixFinal();
        $tmp[] = $aResponse;
        $aResponse['Nom'] = "Nombre de boites Produites";
        $aResponse['Valeur'] = $_data->getNbrBoiteProduite();
        $tmp[] = $aResponse;
        return $tmp;
    }
}
