<?php

namespace App\Entity;

use App\Repository\PaquetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaquetRepository::class)
 */
class Paquet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $codeBarre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dateDepart;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=PaquetBordereau::class, mappedBy="paquet")
     */
    private $paquetBordereaus;

    /**
     * @ORM\ManyToOne(targetEntity=AgentPoste::class, inversedBy="paquets")
     */
    private $agent;

    /**
     * @ORM\ManyToOne(targetEntity=Poste::class, inversedBy="paquets")
     */
    private $posteDepart;

    /**
     * @ORM\ManyToOne(targetEntity=Poste::class, inversedBy="paquets")
     */
    private $posteDarrive;

    /**
     * @ORM\ManyToOne(targetEntity=Poste::class, inversedBy="paquets")
     */
    private $situation;

    /**
     * @ORM\OneToMany(targetEntity=Historique::class, mappedBy="paquet")
     */
    private $historiques;

    public function __construct()
    {
        $this->paquetBordereaus = new ArrayCollection();
        $this->historiques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeBarre(): ?int
    {
        return $this->codeBarre;
    }

    public function setCodeBarre(int $codeBarre): self
    {
        $this->codeBarre = $codeBarre;

        return $this;
    }

    public function getDateDepart(): ?string
    {
        return $this->dateDepart;
    }

    public function setDateDepart(string $dateDepart): self
    {
        $this->dateDepart = $dateDepart;

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

    public function getDateCreation(): ?string
    {
        return $this->dateCreation;
    }

    public function setDateCreation(string $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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
            $paquetBordereau->setPaquet($this);
        }

        return $this;
    }

    public function removePaquetBordereau(PaquetBordereau $paquetBordereau): self
    {
        if ($this->paquetBordereaus->removeElement($paquetBordereau)) {
            // set the owning side to null (unless already changed)
            if ($paquetBordereau->getPaquet() === $this) {
                $paquetBordereau->setPaquet(null);
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
        return $this->poste_arrive;
    }

    public function setPosteArrive(?Poste $posteArrive): self
    {
        $this->poste_arrive = $posteArrive;

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
            $historique->setPaquet($this);
        }

        return $this;
    }

    public function removeHistorique(Historique $historique): self
    {
        if ($this->historiques->removeElement($historique)) {
            // set the owning side to null (unless already changed)
            if ($historique->getPaquet() === $this) {
                $historique->setPaquet(null);
            }
        }

        return $this;
    }
}
