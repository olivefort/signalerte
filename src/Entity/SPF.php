<?php

namespace App\Entity;

use App\Repository\SPFRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SPFRepository::class)]
class SPF
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type : 'datetime_immutable')]
    #[Assert\NotNull()]
    private ?\DateTimeImmutable $date;

    #[ORM\Column(type : 'integer')]
    #[Assert\Positive()]
    #[Assert\NotNull()]
    private int $note;




    public function getId(): ?int
    {
        return $this->id;
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

    public function getNote(): ?int
    {
        return $this->note;
    }
    public function setNote(int $note): static
    {
        $this->note = $note;
        return $this;
    }
}
