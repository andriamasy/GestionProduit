<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 */
abstract class Livraison
{


    /**
     * @ORM\Column(type="datetime")
     */
    public $dateLivraison;


    /**
     * @ORM\Column(type="string", length=255)
     */
    public $transporteur;


    /**
     * @ORM\Column(type="string", length=255)
     */
    public $reference;

    public function __construct()
    {
        $this->dateLivraison = new \DateTime();
    }

    abstract protected function getDateLivraison();

    abstract protected function setDateLivraison(\DateTimeInterface $dateLivraison);


    abstract protected function getTransporteur();

    abstract protected function setTransporteur(string $transporteur);


    abstract protected function getReference();

    abstract protected function setReference(string $reference);
}
