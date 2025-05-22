<?php

namespace App\Entity;

use App\Repository\AgentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgentRepository::class)]
class Agent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'agents')]
    private ?Organisme $organisme = null;

    /**
     * @var Collection<int, Resistance>
     */
    #[ORM\ManyToMany(targetEntity: Resistance::class, inversedBy: 'agents')]
    private Collection $resistance;

    /**
     * @var Collection<int, Signalement>
     */
    #[ORM\ManyToMany(targetEntity: Signalement::class, mappedBy: 'agent')]
    private Collection $signalements;

    public function __construct()
    {
        $this->resistance = new ArrayCollection();
        $this->signalements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrganisme(): ?Organisme
    {
        return $this->organisme;
    }

    public function setOrganisme(?Organisme $organisme): static
    {
        $this->organisme = $organisme;

        return $this;
    }

    /**
     * @return Collection<int, Resistance>
     */
    public function getResistance(): Collection
    {
        return $this->resistance;
    }

    public function addResistance(Resistance $resistance): static
    {
        if (!$this->resistance->contains($resistance)) {
            $this->resistance->add($resistance);
        }

        return $this;
    }

    public function removeResistance(Resistance $resistance): static
    {
        $this->resistance->removeElement($resistance);

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
            $signalement->addAgent($this);
        }

        return $this;
    }

    public function removeSignalement(Signalement $signalement): static
    {
        if ($this->signalements->removeElement($signalement)) {
            $signalement->removeAgent($this);
        }

        return $this;
    }

}
