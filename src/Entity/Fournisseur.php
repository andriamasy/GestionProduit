<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FournisseurRepository")
 */
class Fournisseur
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fournisseur", inversedBy="fournisseurs")
     */
    private $fournisseur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Fournisseur", mappedBy="fournisseur")
     */
    private $fournisseurs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Livraisonfournisseur", mappedBy="fournisseur")
     */
    private $livraisonfournisseurs;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\secteur", inversedBy="fournisseurs")
     */
    private $secteur;

    public function __construct()
    {
        $this->fournisseurs = new ArrayCollection();
        $this->livraisonfournisseurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection|Livraisonfournisseur[]
     */
    public function getLivraisonfournisseurs(): Collection
    {
        return $this->livraisonfournisseurs;
    }

    public function addLivraisonfournisseur(Livraisonfournisseur $livraisonfournisseur): self
    {
        if (!$this->livraisonfournisseurs->contains($livraisonfournisseur)) {
            $this->livraisonfournisseurs[] = $livraisonfournisseur;
            $livraisonfournisseur->setFournisseur($this);
        }

        return $this;
    }

    public function removeLivraisonfournisseur(Livraisonfournisseur $livraisonfournisseur): self
    {
        if ($this->livraisonfournisseurs->contains($livraisonfournisseur)) {
            $this->livraisonfournisseurs->removeElement($livraisonfournisseur);
            // set the owning side to null (unless already changed)
            if ($livraisonfournisseur->getFournisseur() === $this) {
                $livraisonfournisseur->setFournisseur(null);
            }
        }

        return $this;
    }

    public function getSecteur(): ?secteur
    {
        return $this->secteur;
    }

    public function setSecteur(?secteur $secteur): self
    {
        $this->secteur = $secteur;

        return $this;
    }

}
