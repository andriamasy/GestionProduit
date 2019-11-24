<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LivraisonClientRepository")
 */
class LivraisonClient extends Livraison
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_livraison;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\commande", inversedBy="livraisonclients")
     */
    private $commande;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommande(): ?commande
    {
        return $this->commande;
    }

    public function setCommande(?commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }
}
