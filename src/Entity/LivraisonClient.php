<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LivraisonClientRepository")
 */
class LivraisonClient extends Livraison
{
    /**
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\commande", inversedBy="livraisonclients")
     */
    private $commande;

    public function getId(): ? int
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

    /**
     * @return DateTimeInterface|null
     */
    protected function getDateLivraison(): ? \DateTimeInterface
    {
        return $this->dateLivraison;
    }

    protected function setDateLivraison( \DateTimeInterface $dateLivraison) : self
    {
        $this->dateLivraison = $dateLivraison;
        return $this;
    }


    protected function getTransporteur(): ? string
    {
        return $this->transporteur;
    }

    protected function setTransporteur(string $transporteur): ? self
    {
        $this->transporteur = $transporteur;
        return $this;
    }


    protected function getReference(): ? string
    {
        $this->reference;
    }

    protected function setReference(string $reference): ? self
    {
        $this->reference = $reference;
        return $this;
    }
}
