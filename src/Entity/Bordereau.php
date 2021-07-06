<?php

namespace App\Entity;

use App\Repository\BordereauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Date;

/**
 * @ORM\Entity(repositoryClass=BordereauRepository::class)
 */
class Bordereau
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numBordereau;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateArrive;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut;

    /**
     * @ORM\OneToMany(targetEntity=PaquetBordereau::class, mappedBy="bordereau")
     */
    private $paquetBordereaus;

    /**
     * @ORM\ManyToOne(targetEntity=AgentPoste::class, inversedBy="bordereaus")
     */
    private $agent;

   

    /**
     * @ORM\ManyToOne(targetEntity=Poste::class, inversedBy="bordereaus")
     */
    private $posteDepart;

    /**
     * @ORM\ManyToOne(targetEntity=Poste::class, inversedBy="bordereaus")
     */
    private $PosteArrive;
     /**
     * @ORM\ManyToOne(targetEntity=Camion::class, inversedBy="bordereaus")
     */
    private $camion;

    /**
     * @ORM\ManyToOne(targetEntity=Livreur::class, inversedBy="bordereaus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $livreur;

    public function __construct()
    {
        $this->paquetBordereaus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumBordereau()
    {
        return $this->numBordereau;
    }

    public function setNumBordereau(string $numBordereau): ?self
    {
        $this->numBordereau = $numBordereau;

        return $this;
    }

    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    public function setDateCreation( $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateArrive()
    {
        return $this->dateArrive;
    }

    public function setDateArrive( $dateArrive): self
    {
        $this->dateArrive = $dateArrive;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection|PaquetBordereau[]
     */
    public function getPaquetBordereaus(): Collection
    {
        return $this->paquetBordereaus;
    }

    public function addPaquetBordereau(PaquetBordereau $paquetBordereau): self
    {
        if (!$this->paquetBordereaus->contains($paquetBordereau)) {
            $this->paquetBordereaus[] = $paquetBordereau;
            $paquetBordereau->setBordereau($this);
        }

        return $this;
    }

    public function removePaquetBordereau(PaquetBordereau $paquetBordereau): self
    {
        if ($this->paquetBordereaus->removeElement($paquetBordereau)) {
            // set the owning side to null (unless already changed)
            if ($paquetBordereau->getBordereau() === $this) {
                $paquetBordereau->setBordereau(null);
            }
        }

        return $this;
    }

    public function getAgent(): ?AgentPoste
    {
        return $this->agent;
    }

    public function setAgent(?AgentPoste $agent): self
    {
        $this->agent = $agent;

        return $this;
    }

    
    public function getPosteDepart(): ?Poste
    {
        return $this->posteDepart;
    }

    public function setPosteDepart(?Poste $posteDepart): self
    {
        $this->posteDepart = $posteDepart;

        return $this;
    }

    public function getPosteArrive(): ?Poste
    {
        return $this->PosteArrive;
    }

    public function setPosteArrive(?Poste $PosteArrive): self
    {
        $this->PosteArrive = $PosteArrive;

        return $this;
    }

    public function getLivreur(): ?Livreur
    {
        return $this->livreur;
    }

    public function setLivreur(?Livreur $livreur): self
    {
        $this->livreur = $livreur;

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
