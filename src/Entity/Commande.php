<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandeRepository")
 */
class Commande
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
    private $reference;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\Column(type="integer")
     */
    private $code;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\user", inversedBy="commandes")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\produit", inversedBy="commandes")
     */
    private $produit;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Livraisonclient", mappedBy="commande")
     */
    private $livraisonclients;

    public function __construct()
    {
        $this->produit = new ArrayCollection();
        $this->livraisonclients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?\DateTimeInterface
    {
        return $this->reference;
    }

    public function setReference(\DateTimeInterface $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|produit[]
     */
    public function getProduit(): Collection
    {
        return $this->produit;
    }

    public function addProduit(produit $produit): self
    {
        if (!$this->produit->contains($produit)) {
            $this->produit[] = $produit;
        }

        return $this;
    }

    public function removeProduit(produit $produit): self
    {
        if ($this->produit->contains($produit)) {
            $this->produit->removeElement($produit);
        }

        return $this;
    }

    /**
     * @return Collection|Livraisonclient[]
     */
    public function getLivraisonclients(): Collection
    {
        return $this->livraisonclients;
    }

    public function addLivraisonclient(Livraisonclient $livraisonclient): self
    {
        if (!$this->livraisonclients->contains($livraisonclient)) {
            $this->livraisonclients[] = $livraisonclient;
            $livraisonclient->setCommande($this);
        }

        return $this;
    }

    public function removeLivraisonclient(Livraisonclient $livraisonclient): self
    {
        if ($this->livraisonclients->contains($livraisonclient)) {
            $this->livraisonclients->removeElement($livraisonclient);
            // set the owning side to null (unless already changed)
            if ($livraisonclient->getCommande() === $this) {
                $livraisonclient->setCommande(null);
            }
        }

        return $this;
    }
}
