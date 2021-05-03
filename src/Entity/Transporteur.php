<?php

namespace App\Entity;

use App\Repository\TransporteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\ManyToOne(targetEntity=Livreur::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $Livreur;

    /**
     * @ORM\OneToMany(targetEntity=Bordereau::class, mappedBy="transporeteur")
     */
    private $bordereaus;

    /**
     * @ORM\OneToMany(targetEntity=Historique::class, mappedBy="transporteur")
     */
    private $historiques;

    /**
     * @ORM\ManyToOne(targetEntity=Camion::class, inversedBy="transporteurs")
     */
    private $camion;

    public function __construct()
    {
        $this->bordereaus = new ArrayCollection();
        $this->historiques = new ArrayCollection();
    }

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
            $bordereau->setTransporeteur($this);
        }

        return $this;
    }

    public function removeBordereau(Bordereau $bordereau): self
    {
        if ($this->bordereaus->removeElement($bordereau)) {
            // set the owning side to null (unless already changed)
            if ($bordereau->getTransporeteur() === $this) {
                $bordereau->setTransporeteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Historique[]
     */
    public function getHistoriques(): Collection
    {
        return $this->historiques;
    }

    public function addHistorique(Historique $historique): self
    {
        if (!$this->historiques->contains($historique)) {
            $this->historiques[] = $historique;
            $historique->setTransporteur($this);
        }

        return $this;
    }

    public function removeHistorique(Historique $historique): self
    {
        if ($this->historiques->removeElement($historique)) {
            // set the owning side to null (unless already changed)
            if ($historique->getTransporteur() === $this) {
                $historique->setTransporteur(null);
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
