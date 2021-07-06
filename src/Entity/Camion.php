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

    

    

    public function __construct()
    {
        $this->transporteurs = new ArrayCollection();
        $this->livreurs = new ArrayCollection();
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
     * @return Collection|Livreur[]
     */
    public function getLivreurs(): Collection
    {
        return $this->livreurs;
    }

    public function addLivreur(Livreur $livreur): self
    {
        if (!$this->livreurs->contains($livreur)) {
            $this->livreurs[] = $livreur;
            $livreur->setCamion($this);
        }

        return $this;
    }

    public function removeLivreur(Livreur $livreur): self
    {
        if ($this->livreurs->removeElement($livreur)) {
            // set the owning side to null (unless already changed)
            if ($livreur->getCamion() === $this) {
                $livreur->setCamion(null);
            }
        }

        return $this;
    }
}
