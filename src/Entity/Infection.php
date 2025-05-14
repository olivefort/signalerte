<?php

namespace App\Entity;

use App\Repository\InfectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: InfectionRepository::class)]
class Infection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 100)]
    #[Assert\NotBlank()]
    private string $infection;

    /**
     * @var Collection<int, Signalement>
     */
    #[ORM\OneToMany(targetEntity: Signalement::class, mappedBy: 'infection')]
    private Collection $signalements;

    public function __construct()
    {
        $this->signalements = new ArrayCollection();
    }




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInfection(): ?string
    {
        return $this->infection;
    }

    public function setInfection(string $infection): static
    {
        $this->infection = $infection;

        return $this;
    }

    /**
     * @return Collection<int, Signalement>
     */
    public function getSignalements(): Collection
    {
        return $this->signalements;
    }
    public function addSignalement(Signalement $signalement): static
    {
        if (!$this->signalements->contains($signalement)) {
            $this->signalements->add($signalement);
            $signalement->setInfection($this);
        }
        return $this;
    }
    public function removeSignalement(Signalement $signalement): static
    {
        if ($this->signalements->removeElement($signalement)) {
            // set the owning side to null (unless already changed)
            if ($signalement->getInfection() === $this) {
                $signalement->setInfection(null);
            }
        }
        return $this;
    }

    public function __toString()
    {
        return $this->infection;
    }
}
