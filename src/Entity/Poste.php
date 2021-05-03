<?php

namespace App\Entity;

use App\Repository\PosteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PosteRepository::class)
 */
class Poste
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
    private $localisation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomPoste;

    /**
     * @ORM\Column(type="integer")
     */
    private $numeroTelephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Etat;

    /**
     * @ORM\Column(type="integer")
     */
    private $codePostal;

    /**
     * @ORM\OneToMany(targetEntity=Bordereau::class, mappedBy="poste_depart")
     */
    private $bordereaus;

    /**
     * @ORM\OneToMany(targetEntity=Paquet::class, mappedBy="poste_depart")
     */
    private $paquets;

    /**
     * @ORM\OneToMany(targetEntity=Historique::class, mappedBy="situation")
     */
    private $historiques;

    public function __construct()
    {
        $this->bordereaus = new ArrayCollection();
        $this->paquets = new ArrayCollection();
        $this->historiques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getNomPoste(): ?string
    {
        return $this->nomPoste;
    }

    public function setNomPoste(string $nomPoste): self
    {
        $this->nomPoste = $nomPoste;

        return $this;
    }

    public function getNumeroTelephone(): ?int
    {
        return $this->numeroTelephone;
    }

    public function setNumeroTelephone(int $numeroTelephone): self
    {
        $this->numeroTelephone = $numeroTelephone;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->Etat;
    }

    public function setEtat(string $Etat): self
    {
        $this->Etat = $Etat;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->codePostal;
    }

    public function setCodePostal(int $codePostal): self
    {
        $this->codePostal = $codePostal;

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
            $bordereau->setPosteDepart($this);
        }

        return $this;
    }

    public function removeBordereau(Bordereau $bordereau): self
    {
        if ($this->bordereaus->removeElement($bordereau)) {
            // set the owning side to null (unless already changed)
            if ($bordereau->getPosteDepart() === $this) {
                $bordereau->setPosteDepart(null);
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
            $paquet->setPosteDepart($this);
        }

        return $this;
    }

    public function removePaquet(Paquet $paquet): self
    {
        if ($this->paquets->removeElement($paquet)) {
            // set the owning side to null (unless already changed)
            if ($paquet->getPosteDepart() === $this) {
                $paquet->setPosteDepart(null);
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
            $historique->setSituation($this);
        }

        return $this;
    }

    public function removeHistorique(Historique $historique): self
    {
        if ($this->historiques->removeElement($historique)) {
            // set the owning side to null (unless already changed)
            if ($historique->getSituation() === $this) {
                $historique->setSituation(null);
            }
        }

        return $this;
    }
}
