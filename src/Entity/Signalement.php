<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


use App\Repository\SignalementRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SignalementRepository::class)]
class Signalement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type : 'integer')]
    #[Assert\Positive()]
    #[Assert\NotNull()]
    private int $numero;

    #[ORM\Column(type : 'string', length: 10)]
    #[Assert\NotBlank()]
    private string $type;


    #[ORM\Column(type : 'datetime_immutable')]
    #[Assert\NotNull()]
    private?\DateTimeImmutable $date;

    #[ORM\Column(type : 'integer')]
    #[Assert\Positive()]
    #[Assert\NotNull()]
    private int $cas;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank()]
    private string $commentaire;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank()]
    private string $epidemie;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank()]
    private string $gravite;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank()]
    private string $population;
    
    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank()]
    private string $reco;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank()]
    private string $mesure;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank()]
    private string $capacite;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank()]
    private string $impact;

    #[ORM\Column(type: 'integer')]
    #[Assert\Positive()]
    #[Assert\NotNull()]
    private int $score;

    #[ORM\ManyToOne(inversedBy: 'signalements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Infection $infection = null;

    #[ORM\ManyToOne(inversedBy: 'signalements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Etiologie $etiologie = null;

    #[ORM\ManyToOne(inversedBy: 'signalement')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Structure $structure = null;

    /**
     * @var Collection<int, Service>
     */
    #[ORM\ManyToMany(targetEntity: Service::class)]
    private Collection $service;

    // /**
    //  * @var Collection<int, Organisme>
    //  */
    // #[ORM\ManyToMany(targetEntity: Organisme::class, inversedBy: 'signalements')]
    // private Collection $organisme;

    // /**
    //  * @var Collection<int, Resistance>
    //  */
    // #[ORM\ManyToMany(targetEntity: Resistance::class)]
    // private Collection $Resistance;

    /**
     * @var Collection<int, Souche>
     */
    #[ORM\OneToMany(targetEntity: Souche::class, mappedBy: 'signalement', orphanRemoval: true, cascade : ['persist'])]
    private Collection $souche;

    /**
     * @var Collection<int, Contact>
     */
    #[ORM\OneToMany(targetEntity: Contact::class, mappedBy: 'signalement', orphanRemoval: true, cascade : ['persist'])]
    private Collection $contact;

    /**
     * @var Collection<int, Agent>
     */
    #[ORM\ManyToMany(targetEntity: Agent::class, inversedBy: 'signalements', orphanRemoval: true, cascade : ['persist'])]
    private Collection $agent;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $ARS = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $clotureARS = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $ES = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $clotureES = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $CPIAS = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $clotureCPIAS = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $SPF = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $clotureSPF = null;


    public function __construct()
    {
        $this->service = new ArrayCollection();
        // $this->organisme = new ArrayCollection();
        // $this->Resistance = new ArrayCollection();
        $this->souche = new ArrayCollection();
        $this->contact = new ArrayCollection();
        $this->agent = new ArrayCollection();
    }


    
    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): static
    {
        $this->numero = $numero;

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

    public function getCas(): ?int
    {
        return $this->cas;
    }

    public function setCas(int $cas): static
    {
        $this->cas = $cas;
        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): static
    {
        $this->commentaire = $commentaire;
        return $this;
    }

    public function getCapacite(): ?string
    {
        return $this->capacite;
    }
    public function setCapacite(string $capacite): static
    {
        $this->capacite = $capacite;
        return $this;
    }

    public function getEpidemie(): ?string
    {
        return $this->epidemie;
    }
    public function setEpidemie(string $epidemie): static
    {
        $this->epidemie = $epidemie;
        return $this;
    }

    public function getGravite(): ?string
    {
        return $this->gravite;
    }
    public function setGravite(string $gravite): static
    {
        $this->gravite = $gravite;
        return $this;
    }

    public function getImpact(): ?string
    {
        return $this->impact;
    }
    public function setImpact(string $impact): static
    {
        $this->impact = $impact;
        return $this;
    }

    public function getMesure(): ?string
    {
        return $this->mesure;
    }
    public function setMesure(string $mesure): static
    {
        $this->mesure = $mesure;
        return $this;
    }

    public function getReco(): ?string
    {
        return $this->reco;
    }
    public function setReco(string $reco): static
    {
        $this->reco = $reco;
        return $this;
    }

    public function getPopulation(): ?string
    {
        return $this->population;
    }
    public function setPopulation(string $population): static
    {
        $this->population = $population;
        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }
    public function setScore(int $score): static
    {
        $this->score = $score;
        return $this;
    }


    public function getInfection(): ?Infection
    {
        return $this->infection;
    }
    public function setInfection(?Infection $infection): static
    {
        $this->infection = $infection;
        return $this;
    }

    /**
     * @return Collection<int, Service>
     */
    public function getService(): Collection
    {
        return $this->service;
    }
    public function addService(Service $service): static
    {
        if (!$this->service->contains($service)) {
            $this->service->add($service);
        }
        return $this;
    }
    public function removeService(Service $service): static
    {
        $this->service->removeElement($service);
        return $this;
    }

    // /**
    //  * @return Collection<int, Organisme>
    //  */
    // public function getOrganisme(): Collection
    // {
    //     return $this->organisme;
    // }
    // public function addOrganisme(Organisme $organisme): static
    // {
    //     if (!$this->organisme->contains($organisme)) {
    //         $this->organisme->add($organisme);
    //     }
    //     return $this;
    // }
    // public function removeOrganisme(Organisme $organisme): static
    // {
    //     $this->organisme->removeElement($organisme);
    //     return $this;
    // }

    // /**
    //  * @return Collection<int, Resistance>
    //  */
    // public function getResistance(): Collection
    // {
    //     return $this->Resistance;
    // }
    // public function addResistance(Resistance $resistance): static
    // {
    //     if (!$this->Resistance->contains($resistance)) {
    //         $this->Resistance->add($resistance);
    //     }
    //     return $this;
    // }
    // public function removeResistance(Resistance $resistance): static
    // {
    //     $this->Resistance->removeElement($resistance);
    //     return $this;
    // }

    /**
     * @return Collection<int, Souche>
     */
    public function getSouche(): Collection
    {
        return $this->souche;
    }

    public function addSouche(Souche $souche): static
    {
        if (!$this->souche->contains($souche)) {
            $this->souche->add($souche);
            $souche->setSignalement($this);
        }

        return $this;
    }

    public function removeSouche(Souche $souche): static
    {
        if ($this->souche->removeElement($souche)) {
            // set the owning side to null (unless already changed)
            if ($souche->getSignalement() === $this) {
                $souche->setSignalement(null);
            }
        }

        return $this;
    }

        /**
     * @return Collection<int, Contact>
     */
    public function getContact(): Collection
    {
        return $this->contact;
    }

    public function addContact(Contact $contact): static
    {
        if (!$this->contact->contains($contact)) {
            $this->contact->add($contact);
            $contact->setSignalement($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): static
    {
        if ($this->contact->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getSignalement() === $this) {
                $contact->setSignalement(null);
            }
        }

        return $this;
    }

     /**
     * @return Collection<int, Agent>
     */
    public function getAgent(): Collection
    {
        return $this->agent;
    }

    public function addAgent(Agent $agent): static
    {
        if (!$this->agent->contains($agent)) {
            $this->agent->add($agent);
        }
        return $this;
    }

    public function removeAgent(Agent $agent): static
    {
        $this->agent->removeElement($agent);
        return $this;
    }

    public function __toString()
    {
        return $this->souche;
        return $this->contact;
        return $this->agent;
    }



    public function getEtiologie(): ?Etiologie
    {
        return $this->etiologie;
    }

    public function setEtiologie(?Etiologie $etiologie): static
    {
        $this->etiologie = $etiologie;

        return $this;
    }

    public function getStructure(): ?Structure
    {
        return $this->structure;
    }

    public function setStructure(?Structure $structure): static
    {
        $this->structure = $structure;

        return $this;
    }

    public function getARS(): ?string
    {
        return $this->ARS;
    }

    public function setARS(?string $ARS): static
    {
        $this->ARS = $ARS;

        return $this;
    }

    public function getClotureARS(): ?\DateTimeImmutable
    {
        return $this->clotureARS;
    }

    public function setClotureARS(?\DateTimeImmutable $clotureARS): static
    {
        $this->clotureARS = $clotureARS;

        return $this;
    }

    public function getES(): ?string
    {
        return $this->ES;
    }

    public function setES(?string $ES): static
    {
        $this->ES = $ES;

        return $this;
    }

    public function getClotureES(): ?\DateTimeImmutable
    {
        return $this->clotureES;
    }

    public function setClotureES(?\DateTimeImmutable $clotureES): static
    {
        $this->clotureES = $clotureES;

        return $this;
    }

    public function getCPIAS(): ?string
    {
        return $this->CPIAS;
    }

    public function setCPIAS(?string $CPIAS): static
    {
        $this->CPIAS = $CPIAS;

        return $this;
    }

    public function getClotureCPIAS(): ?\DateTimeImmutable
    {
        return $this->clotureCPIAS;
    }

    public function setClotureCPIAS(?\DateTimeImmutable $clotureCPIAS): static
    {
        $this->clotureCPIAS = $clotureCPIAS;

        return $this;
    }

    public function getSPF(): ?string
    {
        return $this->SPF;
    }

    public function setSPF(?string $SPF): static
    {
        $this->SPF = $SPF;

        return $this;
    }

    public function getClotureSPF(): ?\DateTimeImmutable
    {
        return $this->clotureSPF;
    }

    public function setClotureSPF(?\DateTimeImmutable $clotureSPF): static
    {
        $this->clotureSPF = $clotureSPF;

        return $this;
    }
}