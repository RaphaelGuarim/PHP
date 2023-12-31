<?php

namespace Entity;
use Doctrine\ORM\Mapping as ORM;
use Repository\CommandRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CommandRepository::class)]
#[ORM\Table(name: 'command')]
class Command
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;

    #[ORM\Column(type: 'float')]
    #[Assert\Positive(message: 'The weight must be a positive number')]
    private float $weight;

    #[ORM\Column(type: 'float')]
    #[Assert\Positive(message: 'The price must be a positive number')]
    private float $price;

    #[ORM\Column(type: 'datetime')]
    #[Assert\DateTime(message: 'Invalid date format')]
    private \DateTimeInterface $date;

    #[ORM\Column(type: 'string')]
    private String $adress;

    #[ORM\ManyToOne(targetEntity : 'User')]
    #[ORM\JoinColumn(name:'user_id', referencedColumnName:'id')]
    private $user_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Command
    {
        $this->id = $id;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): Command
    {
        $this->price = $price;
        return $this;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): Command
    {
        $this->weight = $weight;
        return $this;
    }

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): Command
    {
        $this->date = $date;
        return $this;
    }

    public function getAdress(): string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): Command
    {
        $this->adress = $adress;
        return $this;
    }

    // Getter and Setter for $user_id
    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id): Command
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function __toString(): string
    {
        return sprintf('%d %d %d', $this->price, $this->weight,$this->date, $this->user_id);
    }


}