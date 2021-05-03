<?php

namespace App\Entity;

use App\Repository\PaquetBordereauRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaquetBordereauRepository::class)
 */
class PaquetBordereau
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
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity=Paquet::class, inversedBy="paquetBordereaus")
     */
    private $paquet;

    /**
     * @ORM\ManyToOne(targetEntity=Bordereau::class, inversedBy="paquetBordereaus")
     */
    private $bordereau;

    public function getId(): ?int
    {
        return $this->id;

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

    public function getPaquet(): ?Paquet
    {
        return $this->paquet;
    }

    public function setPaquet(?Paquet $paquet): self
    {
        $this->paquet = $paquet;

        return $this;
    }

    public function getBordereau(): ?Bordereau
    {
        return $this->bordereau;
    }

    public function setBordereau(?Bordereau $bordereau): self
    {
        $this->bordereau = $bordereau;

        return $this;
    }


}
