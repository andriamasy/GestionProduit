<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandeRepository")
 * @UniqueEntity(
 *     fields={"reference"}, message="Cette reference {{ value }} est déjà utilisée")
 * @UniqueEntity(
 *     fields={"code"}, message="Cette code {{ value }} est déjà utilisée")
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
     * @ORM\Column(type="string", unique=true)
     */
    private $reference;


    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $code;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="commandes")
     */
    private $user;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LivraisonClient", mappedBy="commande")
     */
    private $livraisonclients;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;


    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;



    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\CommandProduit", mappedBy="command" , cascade={"persist", "remove"})
     */
    private $commandProduits;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isPaid;


    public function __construct()
    {
        $this->livraisonclients = new ArrayCollection();
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


    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Livraisonclient[]
     */
    public function getLivraisonclients(): Collection
    {
        return $this->livraisonclients;
    }

    public function addLivraisonclient(LivraisonClient $livraisonclient): self
    {
        if (!$this->livraisonclients->contains($livraisonclient)) {
            $this->livraisonclients[] = $livraisonclient;
            $livraisonclient->setCommande($this);
        }

        return $this;
    }

    public function removeLivraisonclient(LivraisonClient $livraisonclient): self
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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
            $commandProduit->setCommand($this);
        }

        return $this;
    }

    public function removeCommandProduit(CommandProduit $commandProduit): self
    {
        if ($this->commandProduits->contains($commandProduit)) {
            $this->commandProduits->removeElement($commandProduit);
            // set the owning side to null (unless already changed)
            if ($commandProduit->getCommand() === $this) {
                $commandProduit->setCommand(null);
            }
        }

        return $this;
    }

    public function getIsPaid(): ?bool
    {
        return $this->isPaid;
    }

    public function setIsPaid(?bool $isPaid): self
    {
        $this->isPaid = $isPaid;

        return $this;
    }
}
