<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 */
class Produit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255 , unique=true)
     */
    private $reference;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $precaution;

    /**
     * @var Category
     * @ORM\ManyToOne(targetEntity="App\Entity\Category")
     */
    private $category;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="float", scale=4, nullable=true)
     */
    private $poidDufruitAcheter;

    /**
     * @ORM\Column(type="float", scale=4, nullable=true)
     */
    private $poidDufruitepluches;

    /**
     * @ORM\Column(type="float",  scale=4, nullable=true)
     */
    private $PassageRaffiner;

    /**
     * @ORM\Column(type="float", scale=4, nullable=true)
     */
    private $nombreTamissage;

    /**
     * @ORM\Column(type="float", scale=4, nullable=true)
     */
    private $poidDuFruitTamisse;

    /**
     * @ORM\Column(type="float", scale=4,   nullable=true)
     */
    private $passageEmissionneuse;

    /**
     * @ORM\Column(type="float", scale=4, nullable=true)
     */
    private $QteEau;

    /**
     * @ORM\Column(type="float", scale=4, nullable=true)
     */
    private $poidFinal;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $MesurrPHAvant;

    /**
     * @ORM\Column(type="float",  scale=4,  nullable=true)
     */
    private $qteAcide;

    /**
     * @ORM\Column(type="float", scale=4,  nullable=true)
     */
    private $mesurePHApres;

    /**
     * @ORM\Column(type="float", scale=4,  nullable=true)
     */
    private $mesureBrix;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $qteSucre;

    /**
     * @ORM\Column(type="float", scale=3, nullable=true)
     */
    private $mesureBrixFinal;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrBoiteProduite;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDelete;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommandProduit", mappedBy="produit")
     */
    private $commandProduits;


    public function __construct()
    {
        $this->isDelete = false;
        $this->commandProduits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
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

    public function getPrecaution(): ?string
    {
        return $this->precaution;
    }

    public function setPrecaution(?string $precaution): self
    {
        $this->precaution = $precaution;

        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory(Category $category = null)
    {
        $this->category = $category;
        return $this;
    }

    public function addCategory(Category $category = null): self
    {
        $this->category = $category;
        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->category->contains($category)) {
            $this->category->removeElement($category);
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getPoidDufruitAcheter(): ?float
    {
        return $this->poidDufruitAcheter;
    }

    public function setPoidDufruitAcheter(?float $poidDufruitAcheter): self
    {
        $this->poidDufruitAcheter = $poidDufruitAcheter;

        return $this;
    }

    public function getPoidDufruitepluches(): ?float
    {
        return $this->poidDufruitepluches;
    }

    public function setPoidDufruitepluches(?float $poidDufruitepluches): self
    {
        $this->poidDufruitepluches = $poidDufruitepluches;

        return $this;
    }

    public function getPassageRaffiner(): ?float
    {
        return $this->PassageRaffiner;
    }

    public function setPassageRaffiner(?float $PassageRaffiner): self
    {
        $this->PassageRaffiner = $PassageRaffiner;

        return $this;
    }

    public function getNombreTamissage(): ?float
    {
        return $this->nombreTamissage;
    }

    public function setNombreTamissage(?float $nombreTamissage): self
    {
        $this->nombreTamissage = $nombreTamissage;

        return $this;
    }

    public function getPoidDuFruitTamisse(): ?float
    {
        return $this->poidDuFruitTamisse;
    }

    public function setPoidDuFruitTamisse(?float $poidDuFruitTamisse): self
    {
        $this->poidDuFruitTamisse = $poidDuFruitTamisse;

        return $this;
    }

    public function getPassageEmissionneuse(): ?float
    {
        return $this->passageEmissionneuse;
    }

    public function setPassageEmissionneuse(?float $passageEmissionneuse): self
    {
        $this->passageEmissionneuse = $passageEmissionneuse;

        return $this;
    }

    public function getQteEau(): ?float
    {
        return $this->QteEau;
    }

    public function setQteEau(?float $QteEau): self
    {
        $this->QteEau = $QteEau;

        return $this;
    }

    public function getPoidFinal(): ?float
    {
        return $this->poidFinal;
    }

    public function setPoidFinal(?float $poidFinal): self
    {
        $this->poidFinal = $poidFinal;

        return $this;
    }

    public function getMesurrPHAvant(): ?float
    {
        return $this->MesurrPHAvant;
    }

    public function setMesurrPHAvant(?float $MesurrPHAvant): self
    {
        $this->MesurrPHAvant = $MesurrPHAvant;

        return $this;
    }

    public function getQteAcide(): ?float
    {
        return $this->qteAcide;
    }

    public function setQteAcide(?float $qteAcide): self
    {
        $this->qteAcide = $qteAcide;

        return $this;
    }

    public function getMesurePHApres(): ?float
    {
        return $this->mesurePHApres;
    }

    public function setMesurePHApres(?float $mesurePHApres): self
    {
        $this->mesurePHApres = $mesurePHApres;

        return $this;
    }

    public function getMesureBrix(): ?float
    {
        return $this->mesureBrix;
    }

    public function setMesureBrix(?float $mesureBrix): self
    {
        $this->mesureBrix = $mesureBrix;

        return $this;
    }

    public function getQteSucre(): ?float
    {
        return $this->qteSucre;
    }

    public function setQteSucre(?float $qteSucre): self
    {
        $this->qteSucre = $qteSucre;

        return $this;
    }

    public function getMesureBrixFinal(): ?float
    {
        return $this->mesureBrixFinal;
    }

    public function setMesureBrixFinal(?float $mesureBrixFinal): self
    {
        $this->mesureBrixFinal = (double) $mesureBrixFinal;

        return $this;
    }

    public function getNbrBoiteProduite(): ?int
    {
        return $this->nbrBoiteProduite;
    }

    public function setNbrBoiteProduite(?int $nbrBoiteProduite): self
    {
        $this->nbrBoiteProduite = $nbrBoiteProduite;

        return $this;
    }

    public function getIsDelete(): ?bool
    {
        return $this->isDelete;
    }

    public function setIsDelete(bool $isDelete): self
    {
        $this->isDelete = $isDelete;

        return $this;
    }

    /**
     * @return Collection|CommandProduit[]
     */
    public function getCommandProduits(): Collection
    {
        return $this->commandProduits;
    }

    public function addCommandProduit(CommandProduit $commandProduit): self
    {
        if (!$this->commandProduits->contains($commandProduit)) {
            $this->commandProduits[] = $commandProduit;
            $commandProduit->setProduit($this);
        }

        return $this;
    }

    public function removeCommandProduit(CommandProduit $commandProduit): self
    {
        if ($this->commandProduits->contains($commandProduit)) {
            $this->commandProduits->removeElement($commandProduit);
            // set the owning side to null (unless already changed)
            if ($commandProduit->getProduit() === $this) {
                $commandProduit->setProduit(null);
            }
        }

        return $this;
    }

}
