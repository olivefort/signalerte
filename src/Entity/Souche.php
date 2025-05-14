<?php

namespace App\Entity;

use App\Repository\SoucheRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SoucheRepository::class)]
class Souche
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type : 'string', length: 10)]
    #[Assert\NotBlank()]
    private string $laboratoire;

    #[ORM\Column(type : 'datetime_immutable')]
    #[Assert\NotNull()]
    private ?\DateTimeImmutable $date;

    #[ORM\Column(type : 'integer', nullable: true)]
    #[Assert\NotNull()]
    #[Assert\Positive()]
    private ?int $numero = null;

    #[ORM\ManyToOne(inversedBy: 'souche')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Signalement $signalement = null;




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLaboratoire(): ?string
    {
        return $this->laboratoire;
    }
    public function setLaboratoire(string $laboratoire): static
    {
        $this->laboratoire = $laboratoire;
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

    public function getNumero(): ?int
    {
        return $this->numero;
    }
    public function setNumero(?int $numero): static
    {
        $this->numero = $numero;
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
