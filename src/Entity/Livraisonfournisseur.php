<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LivraisonfournisseurRepository")
 */
class Livraisonfournisseur extends Livraison
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fournisseur", inversedBy="livraisonfournisseurs")
     */
    private $fournisseur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    protected function getDateLivraison()
    {
        // TODO: Implement getDateLivraison() method.
    }

    protected function setDateLivraison(\DateTimeInterface $dateLivraison)
    {
        // TODO: Implement setDateLivraison() method.
    }

    protected function getDestination()
    {
        // TODO: Implement getDestination() method.
    }

    protected function setDestination(string $destination)
    {
        // TODO: Implement setDestination() method.
    }

    protected function getTransporteur()
    {
        // TODO: Implement getTransporteur() method.
    }

    protected function setTransporteur(string $transporteur)
    {
        // TODO: Implement setTransporteur() method.
    }

    protected function getDesignation()
    {
        // TODO: Implement getDesignation() method.
    }

    protected function setDesignation(string $designation)
    {
        // TODO: Implement setDesignation() method.
    }

    protected function getReference()
    {
        // TODO: Implement getReference() method.
    }

    protected function setReference(string $reference)
    {
        // TODO: Implement setReference() method.
    }
}
