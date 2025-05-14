<?php

namespace App\Entity;

use App\Repository\StructureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: StructureRepository::class)]
class Structure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'integer', length: 9)]
    #[Assert\Length(min: 9, max: 9)]
    #[Assert\Positive()]
    #[Assert\NotNull()]
    private int $finessG;

    #[ORM\Column(type: 'integer', length: 9)]
    #[Assert\Length(min: 9, max: 9)]
    #[Assert\Positive()]
    #[Assert\NotNull()]
    private int $finessJ;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\Length(min: 2, max: 50)]
    #[Assert\NotBlank()]
    private string $nom;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Assert\Positive()]
    private ?int $numero;

    #[ORM\Column(type: 'string', nullable: true)]
    #[Assert\Length(min: 2)]
    private ?string $voie;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    #[Assert\Length(min: 2, max: 50)]
    private ?string $adresse;

    #[ORM\Column(type: 'integer', length: 5)]
    #[Assert\Length(min: 5, max: 5)]
    #[Assert\Positive()]
    #[Assert\NotNull()]
    private int $cp;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\Length(min: 2, max: 50)]
    #[Assert\NotBlank()]
    private string $ville;

    #[ORM\Column(type: 'string', length: 20)]
    #[Assert\Length(min: 4, max: 20)]
    #[Assert\NotBlank()]
    private string $departement;

    #[ORM\Column(type: 'float')]
    #[Assert\Positive()]
    #[Assert\NotNull()]
    private float $longitude;

    #[ORM\Column(type: 'float')]
    #[Assert\Positive()]
    #[Assert\NotNull()]
    private float $latitude;

    #[ORM\Column(type: 'string', length: 15)]
    #[Assert\Length(min: 6, max: 15)]
    private string $type;

    /**
     * @var Collection<int, Signalement>
     */
    #[ORM\OneToMany(targetEntity: Signalement::class, mappedBy: 'structure')]
    private Collection $signalement;

    public function __construct()
    {
        $this->signalement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFinessG(): ?int
    {
        return $this->finessG;
    }

    public function setFinessG(int $finessG): static
    {
        $this->finessG = $finessG;

        return $this;
    }

    public function getFinessJ(): ?int
    {
        return $this->finessJ;
    }

    public function setFinessJ(int $finessJ): static
    {
        $this->finessJ = $finessJ;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

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

    public function getVoie(): ?string
    {
        return $this->voie;
    }

    public function setVoie(?string $voie): static
    {
        $this->voie = $voie;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCp(): ?int
    {
        return $this->cp;
    }

    public function setCp(int $cp): static
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getDepartement(): ?string
    {
        return $this->departement;
    }

    public function setDepartement(string $departement): static
    {
        $this->departement = $departement;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
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

    /**
     * @return Collection<int, Signalement>
     */
    public function getSignalement(): Collection
    {
        return $this->signalement;
    }

    public function addSignalement(Signalement $signalement): static
    {
        if (!$this->signalement->contains($signalement)) {
            $this->signalement->add($signalement);
            $signalement->setStructure($this);
        }

        return $this;
    }

    public function removeSignalement(Signalement $signalement): static
    {
        if ($this->signalement->removeElement($signalement)) {
            // set the owning side to null (unless already changed)
            if ($signalement->getStructure() === $this) {
                $signalement->setStructure(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }
}
