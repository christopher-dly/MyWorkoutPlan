<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank(message: "Le prénom est obligatoire.")]
    #[Assert\Length(max: 50, maxMessage: "Le prénom ne peut pas dépasser 50 caractères.")]
    #[Assert\Length(min: 2, maxMessage: "Le prénom ne peut pas faire moins de 2 caractères.")]
    private ?string $firstName = null;
    
    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank(message: "Le nom est obligatoire.")]
    #[Assert\Length(max: 50, maxMessage: "Le nom ne peut pas dépasser 50 caractères.")]
    #[Assert\Length(min: 2, maxMessage: "Le nom ne peut pas faire moins de 2 caractères.")]
    private ?string $name = null;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    #[Assert\Email(message: "L'adresse email n'est pas valide.")]
    #[Assert\NotBlank(message: "L'adresse email est obligatoire.")]
    private ?string $email = null;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank(message: "Le mot de passe est obligatoire.")]
    #[Assert\Regex(
        pattern: "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/",
        message: "Le mot de passe doit contenir au moins 8 caractères, une lettre minuscule, une lettre majuscule, un chiffre et un caractère spécial."
    )]
    private ?string $password = null;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column(type: 'datetime')]
    #[Assert\NotBlank(message: "La date de naissance est obligatoire.")]
    #[Assert\Date(message: "La date de naissance doit être au format JJ/MM/AAAA")]
    private \DateTimeInterface $date;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Assert\Positive(message: "La taille doit être un nombrepositif")]
    private ?int $size = null;  

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Assert\Positive(message: "Le poids doit être un nombre positif")]
    private ?int $weight = null;

    #[ORM\OneToMany(
        targetEntity:"App\Entity\Planning", 
        mappedBy:"user", 
        cascade:['persist', 'remove']
      )]
      private $plannings;

    #[ORM\OneToMany(
        targetEntity:"App\Entity\Exercice", 
        mappedBy:"user", 
        cascade:['persist', 'remove']
      )]
      private $exercices;

    public function eraseCredentials(): void
    {
        // Cette méthode peut être utilisée pour effacer les données sensibles
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @return  self
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of roles
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * Set the value of roles
     *
     * @return  self
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get the value of date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */
    public function setDate(\DateTimeInterface $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of size
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set the value of size
     *
     * @return  self
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get the value of weight
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set the value of weight
     *
     * @return  self
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    public function __construct()
    {
        $this->plannings = new ArrayCollection();
        $this->exercices = new ArrayCollection();
    }

    public function getPlannings(): Collection
    {
        return $this->plannings;
    }    

    public function addPlanning(Planning $planning): Collection
    {
        $planning->setUser($this);

        $this->plannings->add($planning);

        return $this->plannings;
    }

    public function getExercices(): Collection
    {
        return $this->exercices;
    }    

    public function addExercice(Exercice $exercice): Collection
    {
        $exercice->setUser($this);

        $this->exercices->add($exercice);
        
        return $this->exercices;
    }
}
