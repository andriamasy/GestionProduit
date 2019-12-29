<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\Column(type="boolean")
     */
    private $isActivated;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDeleted;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FicheDeVente", mappedBy="typeProduit")
     */
    private $ficheDeVentes;


    public function __construct()
    {
        $this->produits = new ArrayCollection();
        $this->isDeleted = false;
        $this->ficheDeVentes = new ArrayCollection();
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

    public function getIsActivated(): ?bool
    {
        return $this->isActivated;
    }

    public function setIsActivated(bool $isActivated): self
    {
        $this->isActivated = $isActivated;

        return $this;
    }

    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(bool $isDeleted): self
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    /**
     * @return Collection|FicheDeVente[]
     */
    public function getFicheDeVentes(): Collection
    {
        return $this->ficheDeVentes;
    }

    public function addFicheDeVente(FicheDeVente $ficheDeVente): self
    {
        if (!$this->ficheDeVentes->contains($ficheDeVente)) {
            $this->ficheDeVentes[] = $ficheDeVente;
            $ficheDeVente->setTypeProduit($this);
        }

        return $this;
    }

    public function removeFicheDeVente(FicheDeVente $ficheDeVente): self
    {
        if ($this->ficheDeVentes->contains($ficheDeVente)) {
            $this->ficheDeVentes->removeElement($ficheDeVente);
            // set the owning side to null (unless already changed)
            if ($ficheDeVente->getTypeProduit() === $this) {
                $ficheDeVente->setTypeProduit(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        // TODO: Implement __toString() method.
        return $this->getName();
    }

}
