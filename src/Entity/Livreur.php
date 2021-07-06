<?php

namespace App\Entity;

use App\Repository\LivreurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LivreurRepository::class)
 */
class Livreur  extends User
{
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $intitule;

    /**
     * @ORM\OneToMany(targetEntity=Bordereau::class, mappedBy="livreur")
     */
    private $bordereaus;

    /**
     * @ORM\OneToOne(targetEntity=Camion::class, cascade={"persist", "remove"})
     */
    private $camion;

        

    public function __construct()
    {
        $this->bordereaus = new ArrayCollection();
    }


    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(?string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * @return Collection|Bordereau[]
     */
    public function getBordereaus(): Collection
    {
        return $this->bordereaus;
    }

    public function addBordereau(Bordereau $bordereau): self
    {
        if (!$this->bordereaus->contains($bordereau)) {
            $this->bordereaus[] = $bordereau;
            $bordereau->setLivreur($this);
        }

        return $this;
    }

    public function removeBordereau(Bordereau $bordereau): self
    {
        if ($this->bordereaus->removeElement($bordereau)) {
            // set the owning side to null (unless already changed)
            if ($bordereau->getLivreur() === $this) {
                $bordereau->setLivreur(null);
            }
        }

        return $this;
    }

    public function getCamion(): ?Camion
    {
        return $this->camion;
    }

    public function setCamion(?Camion $camion): self
    {
        $this->camion = $camion;

        return $this;
    }

   

}
