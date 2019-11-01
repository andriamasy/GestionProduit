<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LivraisonClientRepository")
 */
class LivraisonClient
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $date_livraison;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $destinateur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\commande", inversedBy="livraisonclients")
     */
    private $commande;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateLivraison(): ?string
    {
        return $this->date_livraison;
    }

    public function setDateLivraison(string $date_livraison): self
    {
        $this->date_livraison = $date_livraison;

        return $this;
    }

    public function getDestinateur(): ?string
    {
        return $this->destinateur;
    }

    public function setDestinateur(string $destinateur): self
    {
        $this->destinateur = $destinateur;

        return $this;
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
