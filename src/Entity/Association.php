<?php

namespace Entity;
use Doctrine\ORM\Mapping as ORM;
use Repository\AssociationRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AssociationRepository::class)]
#[ORM\Table(name: 'association')]
class Association
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;


    #[ORM\ManyToOne(targetEntity : 'Cart')]
    #[ORM\JoinColumn(name:'cart_id', referencedColumnName:'id')]
    private $cart_id;

    #[ORM\ManyToOne(targetEntity : 'Command')]
    #[ORM\JoinColumn(name:'command_id', referencedColumnName:'id')]
    private $command_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Association
    {
        $this->id = $id;
        return $this;
    }

    // Getter and Setter for $cart_id
    public function getCartId()
    {
        return $this->cart_id;
    }

    public function setCartId($cart_id): Association
    {
        $this->cart_id = $cart_id;
        return $this;
    }

    // Getter and Setter for $command_id
    public function getCommandId()
    {
        return $this->command_id;
    }

    public function setCommandId($command_id): Association
    {
        $this->command_id = $command_id;
        return $this;
    }

    public function __toString(): string
    {
        return sprintf('%d %d %d', $this->cart_id, $this->command_id);
    }


}