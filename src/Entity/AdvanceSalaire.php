<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\AdvanceSalaireRepository")
 */
class AdvanceSalaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $libelle;

    /**
     * @ORM\Column(type="date")
     */
    private $created;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\Column(type="integer")
     */
    private $month;

    /**
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     * @ORM\Column(type="integer")
     */
    private $echance;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Employe", inversedBy="advanceSalaires")
     */
    private $employe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="advanceSalaires")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AdvanceSalaireEcheance", mappedBy="advanceSalaire")
     */
    private $advanceSalaireEcheances;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\Column(type="float")
     */
    private $montantRestant;

    public function __construct()
    {
        $this->advanceSalaireEcheances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getMonth(): ?int
    {
        return $this->month;
    }

    public function setMonth(int $month): self
    {
        $this->month = $month;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getEchance(): ?int
    {
        return $this->echance;
    }

    public function setEchance(int $echance): self
    {
        $this->echance = $echance;

        return $this;
    }

    public function getEmploye(): ?Employe
    {
        return $this->employe;
    }

    public function setEmploye(?Employe $employe): self
    {
        $this->employe = $employe;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|AdvanceSalaireEcheance[]
     */
    public function getAdvanceSalaireEcheances(): Collection
    {
        return $this->advanceSalaireEcheances;
    }

    public function addAdvanceSalaireEcheance(AdvanceSalaireEcheance $advanceSalaireEcheance): self
    {
        if (!$this->advanceSalaireEcheances->contains($advanceSalaireEcheance)) {
            $this->advanceSalaireEcheances[] = $advanceSalaireEcheance;
            $advanceSalaireEcheance->setAdvanceSalaire($this);
        }

        return $this;
    }

    public function removeAdvanceSalaireEcheance(AdvanceSalaireEcheance $advanceSalaireEcheance): self
    {
        if ($this->advanceSalaireEcheances->contains($advanceSalaireEcheance)) {
            $this->advanceSalaireEcheances->removeElement($advanceSalaireEcheance);
            // set the owning side to null (unless already changed)
            if ($advanceSalaireEcheance->getAdvanceSalaire() === $this) {
                $advanceSalaireEcheance->setAdvanceSalaire(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getMontantRestant(): ?float
    {
        return $this->montantRestant;
    }

    public function setMontantRestant(float $montantRestant): self
    {
        $this->montantRestant = $montantRestant;

        return $this;
    }
}
