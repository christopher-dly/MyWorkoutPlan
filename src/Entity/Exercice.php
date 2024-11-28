<?php

namespace App\Entity;

use App\Repository\ExerciceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ExerciceRepository::class)]
class Exercice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank(message: "Le nom de l'exercice est obligatoire.")]
    #[Assert\Length(max: 50, maxMessage: "Le nom de l'exercice ne peut pas dépasser 50 caractères.")]
    private ?string $name = null;

    #[ORM\Column(type: 'string', length: 500)]
    #[Assert\NotBlank(message: "La description de l'exercice est obligatoire.")]
    #[Assert\Length(
        max: 500,
        maxMessage: "La description ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $description = null;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank(message: "La catégorie de l'exercice est obligatoire.")]
    private ?string $categorie = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\NotBlank(message: "Merci d'insérer une image")]
    private ?string $imageExercice = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\NotBlank(message: "Merci d'insérer une image")]
    private ?string $imageMuscleFront = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\NotBlank(message: "Merci d'insérer une image")]
    private ?string $imageMuscleBack = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'exercices')]
    private $user;

    #[ORM\ManyToOne(targetEntity: Planning::class, inversedBy: 'exercices')]
    private $planning;

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
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of categorie
     */ 
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set the value of categorie
     *
     * @return  self
     */ 
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get the value of imageExercice
     */ 
    public function getImageExercice()
    {
        return $this->imageExercice;
    }

    /**
     * Set the value of imageExercice
     *
     * @return  self
     */ 
    public function setImageExercice($imageExercice)
    {
        $this->imageExercice = $imageExercice;

        return $this;
    }

    /**
     * Get the value of imageMuscleFront
     */ 
    public function getImageMuscleFront()
    {
        return $this->imageMuscleFront;
    }

    /**
     * Set the value of imageMuscleFront
     *
     * @return  self
     */ 
    public function setImageMuscleFront($imageMuscleFront)
    {
        $this->imageMuscleFront = $imageMuscleFront;

        return $this;
    }

    /**
     * Get the value of imageMuscleBack
     */ 
    public function getImageMuscleBack()
    {
        return $this->imageMuscleBack;
    }

    /**
     * Set the value of imageMuscleBack
     *
     * @return  self
     */ 
    public function setImageMuscleBack($imageMuscleBack)
    {
        $this->imageMuscleBack = $imageMuscleBack;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPlanning(): ?Planning
    {
        return $this->planning;
    }

    public function setPlanning(?Planning $planning): self
    {
        $this->planning = $planning;

        return $this;
    }
}
