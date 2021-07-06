<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
* @ORM\InheritanceType("JOINED") * @ORM\DiscriminatorColumn(name="type", type="string")
* @ORM\DiscriminatorMap({ "agent" = "App\Entity\AgentPoste", "administrateur" = "App\Entity\Administrateur", "livreur" = "App\Entity\Livreur", "utilisateur" = "App\Entity\User"})
*/
class User implements UserInterface
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

     /**
     * @ORM\Column(type="array", length=255)
     */
    private $roles;

    /**
     * @ORM\Column(type="integer")
     */
    private $numTelephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     */
    private $cin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNumTelephone(): ?int
    {
        return $this->numTelephone;
    }

    public function setNumTelephone(int $numTelephone): self
    {
        $this->numTelephone = $numTelephone;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->email;
    }
    public function setUsername(string $email): self
    {
        $this->email = $email;
        return $this;
    }

        
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function eraseCredentials()
    {
        return null;
    }

    public function getSalt()
    {
        return null;
    }
     
     
    public function getPassword(): ?string
    {
        return $this->password;
    }
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }
    


    public function getRoles(): array
    {
         $roles =  $this->roles;
        $roles[]='ROLE_USER';
    
        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles =($roles) ;
        return $this;
    }
      

    public function getCin(): ?int
    {
        return $this->cin;
    }

    public function setCin(int $cin): self
    {
        $this->cin = $cin;

        return $this;
    }
}
