<?php

namespace App\Entity;

use App\Repository\HistoriqueRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HistoriqueRepository::class)
 */
class Historique
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
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity=AgentPoste::class, inversedBy="historiques")
     * @ORM\JoinColumn(nullable=false)
     */
    private $agent;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity=Transporteur::class, inversedBy="historiques")
     */
    private $transporteur;

    /**
     * @ORM\ManyToOne(targetEntity=Poste::class, inversedBy="historiques")
     */
    private $situation;

    /**
     * @ORM\ManyToOne(targetEntity=Paquet::class, inversedBy="historiques")
     */
    private $paquet;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPaquet(): ?string
    {
        return $this->paquet;
    }

    public function setPaquet(string $paquet): self
    {
        $this->paquet = $paquet;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

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

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getTransporteur(): ?Transporteur
    {
        return $this->transporteur;
    }

    public function setTransporteur(?Transporteur $transporteur): self
    {
        $this->transporteur = $transporteur;

        return $this;
    }

    public function getSituation(): ?Poste
    {
        return $this->situation;
    }

    public function setSituation(?Poste $situation): self
    {
        $this->situation = $situation;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
