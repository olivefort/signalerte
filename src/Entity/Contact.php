<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank()]
    private string $type;

    #[ORM\Column(type : 'datetime_immutable')]
    #[Assert\NotNull()]
    private ?\DateTimeImmutable $date;

    #[ORM\ManyToOne(inversedBy: 'contact')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Signalement $signalement = null;


    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }
    public function setType(string $type): static
    {
        $this->type = $type;
        return $this;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): static
    {
        $this->date = $date;
        return $this;
    }

    public function getSignalement(): ?Signalement
    {
        return $this->signalement;
    }
    public function setSignalement(?Signalement $signalement): static
    {
        $this->signalement = $signalement;
        return $this;
    }
}
