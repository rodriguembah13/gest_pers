<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EntrepriseRepository")
 */
class Entreprise
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
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\WorkDay", mappedBy="entreprise")
     */
    private $workDays;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $directeur;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $capital;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fax;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateAutorisation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $autorisation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ville;

    public function __construct()
    {
        $this->workDays = new ArrayCollection();
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->libelle;
    }

    /**
     * @return Collection|WorkDay[]
     */
    public function getWorkDays(): Collection
    {
        return $this->workDays;
    }

    public function addWorkDay(WorkDay $workDay): self
    {
        if (!$this->workDays->contains($workDay)) {
            $this->workDays[] = $workDay;
            $workDay->setEntreprise($this);
        }

        return $this;
    }

    public function removeWorkDay(WorkDay $workDay): self
    {
        if ($this->workDays->contains($workDay)) {
            $this->workDays->removeElement($workDay);
            // set the owning side to null (unless already changed)
            if ($workDay->getEntreprise() === $this) {
                $workDay->setEntreprise(null);
            }
        }

        return $this;
    }

    public function getDirecteur(): ?string
    {
        return $this->directeur;
    }

    public function setDirecteur(?string $directeur): self
    {
        $this->directeur = $directeur;

        return $this;
    }

    public function getCapital(): ?float
    {
        return $this->capital;
    }

    public function setCapital(?float $capital): self
    {
        $this->capital = $capital;

        return $this;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(?string $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getDateAutorisation(): ?\DateTimeInterface
    {
        return $this->dateAutorisation;
    }

    public function setDateAutorisation(?\DateTimeInterface $dateAutorisation): self
    {
        $this->dateAutorisation = $dateAutorisation;

        return $this;
    }

    public function getAutorisation(): ?string
    {
        return $this->autorisation;
    }

    public function setAutorisation(?string $autorisation): self
    {
        $this->autorisation = $autorisation;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(?string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

}
