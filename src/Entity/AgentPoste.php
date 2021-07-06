<?php

namespace App\Entity;

use App\Repository\AgentPosteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AgentPosteRepository::class)
 */
class AgentPoste extends User
{
 

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $posteOccupe;

    /**
     * @ORM\OneToMany(targetEntity=Historique::class, mappedBy="agent")
     */
    private $historiques;

    /**
     * @ORM\OneToMany(targetEntity=Bordereau::class, mappedBy="agent")
     */
    private $bordereaus;

    /**
     * @ORM\OneToMany(targetEntity=Paquet::class, mappedBy="agent")
     */
    private $paquets;

    /**
     * @ORM\ManyToOne(targetEntity=Poste::class, inversedBy="agentPostes")
     * @ORM\JoinColumn(nullable=true)
     */
    private $poste;


    public function __construct()
    {
        $this->historiques = new ArrayCollection();
        $this->bordereaus = new ArrayCollection();
        $this->paquets = new ArrayCollection();
    }

   
    public function getPosteOccupe(): ?string
    {
        return $this->posteOccupe;
    }

    public function setPosteOccupe(string $posteOccupe): self
    {
        $this->posteOccupe = $posteOccupe;

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
            $historique->setAgent($this);
        }

        return $this;
    }

    public function removeHistorique(Historique $historique): self
    {
        if ($this->historiques->removeElement($historique)) {
            // set the owning side to null (unless already changed)
            if ($historique->getAgent() === $this) {
                $historique->setAgent(null);
            }
        }

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
            $bordereau->setAgent($this);
        }

        return $this;
    }

    public function removeBordereau(Bordereau $bordereau): self
    {
        if ($this->bordereaus->removeElement($bordereau)) {
            // set the owning side to null (unless already changed)
            if ($bordereau->getAgent() === $this) {
                $bordereau->setAgent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Paquet[]
     */
    public function getPaquets(): Collection
    {
        return $this->paquets;
    }

    public function addPaquet(Paquet $paquet): self
    {
        if (!$this->paquets->contains($paquet)) {
            $this->paquets[] = $paquet;
            $paquet->setAgent($this);
        }

        return $this;
    }

    public function removePaquet(Paquet $paquet): self
    {
        if ($this->paquets->removeElement($paquet)) {
            // set the owning side to null (unless already changed)
            if ($paquet->getAgent() === $this) {
                $paquet->setAgent(null);
            }
        }

        return $this;
    }

    public function getPoste(): ?Poste
    {
        return $this->poste;
    }

    public function setPoste(?Poste $poste): self
    {
        $this->poste = $poste;

        return $this;
    }

}
