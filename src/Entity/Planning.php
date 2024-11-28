<?php

namespace App\Entity;

use App\Repository\PlanningRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PlanningRepository::class)]
class Planning
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank(message: "Le nom du planning est obligatoire.")]
    #[Assert\Length(max: 50, maxMessage: "Le nom du planning ne peut pas dépasser 50 caractères.")]
    private ?string $name = null;

    #[ORM\Column(type: 'string', length: 500, nullable: true)]
    #[Assert\Length(
        max: 500,
        maxMessage: "La description ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $description = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'plannings')]
    private $user;

    #[ORM\OneToMany(
        targetEntity: "App\Entity\Exercice",
        mappedBy: "planning",
        cascade: ['persist', 'remove']
    )]
    private $exercices;

    public function __construct()
    {
        $this->date = new DateTime();
        $this->exercices = new ArrayCollection();
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
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

    public function getExercices(): Collection
    {
        return $this->exercices;
    }

    public function addExercice(Exercice $exercice): Collection
    {
        $exercice->setPlanning($this);

        $this->exercices->add($exercice);

        return $this->exercices;
    }
}
