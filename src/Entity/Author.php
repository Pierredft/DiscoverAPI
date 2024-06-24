<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\ORM\Mapping as ORM;
// use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AuthorRepository::class)]
class Author
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["getBooks", "getAuthors"])]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(["getBooks","getAuthors"])]
    #[Assert\NotBlank(message: "Le nom de l'auteur est obligatoire")]
    private ?string $FirstName = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(["getBooks", "getAuthors"])]
    private ?string $LastName = null;

    #[ORM\OneToMany(mappedBy:"author", targetEntity: Book::class, orphanRemoval: true)]
    #[Groups(["getAuthors"])]
    private $books;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(?string $FirstName): static
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(?string $LastName): static
    {
        $this->LastName = $LastName;

        return $this;
    }
}
