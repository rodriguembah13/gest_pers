<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContratRepository")
 */
class Contrat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="date", length=255)
     */
    private $dateFin;

    /**
     * @ORM\Column(type="date")
     */
    private $finEssai;

    /**
     * @ORM\Column(type="integer")
     */
    private $salaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Employe", inversedBy="rhcontrats")
     */
    private $employe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeContrat")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $satut;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RhBulletinPaie", mappedBy="rhcontrat")
     */
    private $rhBulletinPaies;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $enfants;

    public function __construct()
    {
        $this->rhBulletinPaies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getFinEssai(): ?\DateTimeInterface
    {
        return $this->finEssai;
    }

    public function setFinEssai(\DateTimeInterface $finEssai): self
    {
        $this->finEssai = $finEssai;

        return $this;
    }

    public function getSalaire(): ?int
    {
        return $this->salaire;
    }

    public function setSalaire(int $salaire): self
    {
        $this->salaire = $salaire;

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

    public function getType(): ?TypeContrat
    {
        return $this->type;
    }

    public function setType(?TypeContrat $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSatut(): ?string
    {
        return $this->satut;
    }

    public function setSatut(string $satut): self
    {
        $this->satut = $satut;

        return $this;
    }

    /**
     * @return Collection|RhBulletinPaie[]
     */
    public function getRhBulletinPaies(): Collection
    {
        return $this->rhBulletinPaies;
    }

    public function addRhBulletinPaie(RhBulletinPaie $rhBulletinPaie): self
    {
        if (!$this->rhBulletinPaies->contains($rhBulletinPaie)) {
            $this->rhBulletinPaies[] = $rhBulletinPaie;
            $rhBulletinPaie->setRhcontrat($this);
        }

        return $this;
    }

    public function removeRhBulletinPaie(RhBulletinPaie $rhBulletinPaie): self
    {
        if ($this->rhBulletinPaies->contains($rhBulletinPaie)) {
            $this->rhBulletinPaies->removeElement($rhBulletinPaie);
            // set the owning side to null (unless already changed)
            if ($rhBulletinPaie->getRhcontrat() === $this) {
                $rhBulletinPaie->setRhcontrat(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->libelle;
    }

    public function getEnfants(): ?int
    {
        return $this->enfants;
    }

    public function setEnfants(?int $enfants): self
    {
        $this->enfants = $enfants;

        return $this;
    }

}
