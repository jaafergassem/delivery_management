<?php

namespace App\Entity;

use App\Repository\TransporteurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TransporteurRepository::class)
 */
class Transporteur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Livreur::class, cascade={"persist", "remove"})
     */
    private $Livreur;

    /**
     * @ORM\OneToOne(targetEntity=Camion::class, cascade={"persist", "remove"})
     */
    private $Camion;

    /**
     * @ORM\Column(type="boolean")
     */
    private $affectation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLivreur(): ?Livreur
    {
        return $this->Livreur;
    }

    public function setLivreur(?Livreur $Livreur): self
    {
        $this->Livreur = $Livreur;

        return $this;
    }

    public function getCamion(): ?Camion
    {
        return $this->Camion;
    }

    public function setCamion(?Camion $Camion): self
    {
        $this->Camion = $Camion;

        return $this;
    }

    public function getAffectation(): ?bool
    {
        return $this->affectation;
    }

    public function setAffectation(bool $affectation): self
    {
        $this->affectation = $affectation;

        return $this;
    }
}
