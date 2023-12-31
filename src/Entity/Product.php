<?php

namespace Entity;
use Doctrine\ORM\Mapping as ORM;
use Repository\ProductRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\Table(name: 'product')]
class Product
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Your name must be at least {{ limit }} characters long',
        maxMessage: 'Your name cannot be longer than {{ limit }} characters',
    )]
    private string $name;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 1000,
        minMessage: 'Your photo name must be at least {{ limit }} characters long',
        maxMessage: 'Your photo name cannot be longer than {{ limit }} characters',
    )]
    private string $photo;

    #[ORM\Column(type: 'float')]
    #[Assert\NotBlank]
    #[Assert\Positive(message: 'The price must be a positive number')]
    private float $price;

    #[ORM\Column(type: 'float')]
    #[Assert\NotBlank]
    #[Assert\Positive(message: 'The weight must be a positive number')]
    private float $weight;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Product
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Product
    {
        $this->name = $name;
        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): Product
    {
        $this->photo = $photo;
        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): Product
    {
        $this->price = $price;
        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): Product
    {
        $this->weight = $weight;
        return $this;
    }

    public function __toString(): string
    {
        return sprintf('%s %f %f', $this->name, $this->price, $this->weight);
    }


}