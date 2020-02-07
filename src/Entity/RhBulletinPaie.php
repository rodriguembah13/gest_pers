<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\RhBulletinPaieRepository")
 */
class RhBulletinPaie
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
     * @ORM\Column(type="string", nullable=true)
     */
    private $etat;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datecreation;

    /**
     * @ORM\Column(type="date")
     */
    private $datepaie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Contrat", inversedBy="rhBulletinPaies")
     */
    private $rhcontrat;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rhlignereglepaie", mappedBy="rhBulletinPaie")
     */
    private $rhlignereglepaies;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rhstructuresalaire", inversedBy="rhBulletinPaies")
     */
    private $rhstructurepaie;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $periodeDebut;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $periodeFin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Employe", inversedBy="rhBulletinPaies")
     */
    private $employe;

    public function __construct()
    {
        $this->rhlignereglepaies = new ArrayCollection();
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

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(?string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getDatecreation(): ?\DateTimeInterface
    {
        return $this->datecreation;
    }

    public function setDatecreation(?\DateTimeInterface $datecreation): self
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    public function getDatepaie(): ?\DateTimeInterface
    {
        return $this->datepaie;
    }

    public function setDatepaie(\DateTimeInterface $datepaie): self
    {
        $this->datepaie = $datepaie;

        return $this;
    }

    public function getRhcontrat(): ?Contrat
    {
        return $this->rhcontrat;
    }

    public function setRhcontrat(?Contrat $rhcontrat): self
    {
        $this->rhcontrat = $rhcontrat;

        return $this;
    }

    /**
     * @return Collection|Rhlignereglepaie[]
     */
    public function getRhlignereglepaies(): Collection
    {
        return $this->rhlignereglepaies;
    }

    public function addRhlignereglepaie(Rhlignereglepaie $rhlignereglepaie): self
    {
        if (!$this->rhlignereglepaies->contains($rhlignereglepaie)) {
            $this->rhlignereglepaies[] = $rhlignereglepaie;
            $rhlignereglepaie->setRhBulletinPaie($this);
        }

        return $this;
    }

    public function removeRhlignereglepaie(Rhlignereglepaie $rhlignereglepaie): self
    {
        if ($this->rhlignereglepaies->contains($rhlignereglepaie)) {
            $this->rhlignereglepaies->removeElement($rhlignereglepaie);
            // set the owning side to null (unless already changed)
            if ($rhlignereglepaie->getRhBulletinPaie() === $this) {
                $rhlignereglepaie->setRhBulletinPaie(null);
            }
        }

        return $this;
    }

    public function getRhstructurepaie(): ?Rhstructuresalaire
    {
        return $this->rhstructurepaie;
    }

    public function setRhstructurepaie(?Rhstructuresalaire $rhstructurepaie): self
    {
        $this->rhstructurepaie = $rhstructurepaie;

        return $this;
    }

    public function getPeriodeDebut(): ?\DateTimeInterface
    {
        return $this->periodeDebut;
    }

    public function setPeriodeDebut(?\DateTimeInterface $periodeDebut): self
    {
        $this->periodeDebut = $periodeDebut;

        return $this;
    }

    public function getPeriodeFin(): ?\DateTimeInterface
    {
        return $this->periodeFin;
    }

    public function setPeriodeFin(?\DateTimeInterface $periodeFin): self
    {
        $this->periodeFin = $periodeFin;

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
}
