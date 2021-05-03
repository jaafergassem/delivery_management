<?php

namespace App\Entity;

use App\Repository\CamionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CamionRepository::class)
 */
class Camion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $matriculeCamion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $intitule;

    /**
     * @ORM\OneToMany(targetEntity=Transporteur::class, mappedBy="camion")
     */
    private $transporteurs;

    public function __construct()
    {
        $this->transporteurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatriculeCamion(): ?string
    {
        return $this->matriculeCamion;
    }

    public function setMatriculeCamion(string $matriculeCamion): self
    {
        $this->matriculeCamion = $matriculeCamion;

        return $this;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * @return Collection|Transporteur[]
     */
    public function getTransporteurs(): Collection
    {
        return $this->transporteurs;
    }

    public function addTransporteur(Transporteur $transporteur): self
    {
        if (!$this->transporteurs->contains($transporteur)) {
            $this->transporteurs[] = $transporteur;
            $transporteur->setCamion($this);
        }

        return $this;
    }

    public function removeTransporteur(Transporteur $transporteur): self
    {
        if ($this->transporteurs->removeElement($transporteur)) {
            // set the owning side to null (unless already changed)
            if ($transporteur->getCamion() === $this) {
                $transporteur->setCamion(null);
            }
        }

        return $this;
    }
}
