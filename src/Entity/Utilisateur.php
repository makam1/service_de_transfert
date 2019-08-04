<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 *  @UniqueEntity(fields={"username"}, message="Cet utilisateur existe déjà")
 * @Vich\Uploadable
 */
class Utilisateur implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank(message="Renseigner le username")
     * @Assert\Length(min="5",minMessage="La longueur du username est de 5",max="10",maxMessage="La longueur du username est de 10")
    *   @Assert\Type(
     *     type="string",
     *     message="Le username le est de type string."
     */
    private $username;
   

    /**
     * @ORM\Column(type="json")
     */
    
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Renseignez le password")
     * @Assert\Length(min="7",minMessage="Le mot de pase doit etre long 7 caractères minimum",max="15",maxMessage="Le mot de pase doit etre long 7 caractères maximum")
    *@Assert\Type(
     *     type="string",
     *     message="Le mot de passe est de type string."
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\NotBlank(message="Renseignez le nom")
     * @Assert\Length(min="2",minMessage="Le nom doit etre long 2 caractères minimum",max="10",maxMessage="Le mot de pase doit etre long 10 caractères maximum")
    *@Assert\Type(
     *     type="string",
     *     message="Le nom est de type string."
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=40)
     * @Assert\NotBlank(message="Renseignez l'email")
     * @Assert\Length(min="10",minMessage="L'email' doit etre long 10 caractères minimum",max="20",maxMessage="L'email' doit etre long 10 caractères maximum")
    *@Assert\Type(
     *     type="email",
     *     message="Donner un email valide"
     * @Assert\Email
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Renseignez le téléphone")
     * @Assert\Length(min="9",message="Le téléphone doit etre long 9 caractères minimum",max="20")
    *@Assert\Type(
     *     type="integer",
     *     message="Le télephone est de type integer"
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank(message="Renseignez le statut")
     * 
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Partenaire", inversedBy="utilisateurs")
     * @Assert\NotBlank(message="Renseigner le partenaire")
     * @Assert\Positive
     * @Assert\Type(
     *     type="integer",
     *     message="Le partenaire est de type integer."
     */
    private $partenaire;
 /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="utilisateurs", fileNameProperty="image")
     * @var File
     */
    private $imageFile;
   /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if ($this->imageFile instanceof UploadedFile) {
            $this->updatedAt = new \DateTime('now');
        }
          
               

    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

        /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_ADMIN';
        return array_unique($roles);
    }
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }


    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

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

    public function getPartenaire(): ?Partenaire
    {
        return $this->partenaire;
    }

    public function setPartenaire(?Partenaire $partenaire): self
    {
        $this->partenaire = $partenaire;

        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

}
