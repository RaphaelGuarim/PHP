<?php

namespace Entity;
use Doctrine\ORM\Mapping as ORM;
use Repository\CartRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CartRepository::class)]
#[ORM\Table(name: 'cart')]
class Cart
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\Positive(message: 'The quantity must be a positive number')]
    private int $quantity;

    #[ORM\Column(type: 'float')]
    #[Assert\Positive(message: 'The weight must be a positive number')]
    private float $weight;

    #[ORM\Column(type: 'float')]
    #[Assert\Positive(message: 'The price must be a positive number')]
    private float $price;

    #[ORM\ManyToOne(targetEntity : 'Product')]
    #[ORM\JoinColumn(name:'product_id', referencedColumnName:'id')]
    private $product_id;

    #[ORM\ManyToOne(targetEntity : 'User')]
    #[ORM\JoinColumn(name:'user_id', referencedColumnName:'id')]
    private $user_id;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Cart
    {
        $this->id = $id;
        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): Cart
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): Cart
    {
        $this->price = $price;
        return $this;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): Cart
    {
        $this->weight = $weight;
        return $this;
    }

    // Getter and Setter for $product_id
    public function getProductId()
    {
        return $this->product_id;
    }

    public function setProductId($product_id): Cart
    {
        $this->product_id = $product_id;
        return $this;
    }

    // Getter and Setter for $user_id
    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id): Cart
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function __toString(): string
    {
        return sprintf('%d %d %d', $this->quantity, $this->product_id, $this->user_id);
    }


}