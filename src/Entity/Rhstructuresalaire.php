<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\RhstructuresalaireRepository")
 */
class Rhstructuresalaire
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
    private $reference;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rhlignereglestructure", mappedBy="rhstructuresalaire")
     */
    private $rhlignereglestructures;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RhBulletinPaie", mappedBy="rhstructurepaie")
     */
    private $rhBulletinPaies;

    public function __construct()
    {
        $this->rhlignereglestructures = new ArrayCollection();
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

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return Collection|Rhlignereglestructure[]
     */
    public function getRhlignereglestructures(): Collection
    {
        return $this->rhlignereglestructures;
    }

    public function addRhlignereglestructure(Rhlignereglestructure $rhlignereglestructure): self
    {
        if (!$this->rhlignereglestructures->contains($rhlignereglestructure)) {
            $this->rhlignereglestructures[] = $rhlignereglestructure;
            $rhlignereglestructure->setRhstructuresalaire($this);
        }

        return $this;
    }

    public function removeRhlignereglestructure(Rhlignereglestructure $rhlignereglestructure): self
    {
        if ($this->rhlignereglestructures->contains($rhlignereglestructure)) {
            $this->rhlignereglestructures->removeElement($rhlignereglestructure);
            // set the owning side to null (unless already changed)
            if ($rhlignereglestructure->getRhstructuresalaire() === $this) {
                $rhlignereglestructure->setRhstructuresalaire(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->libelle;
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
            $rhBulletinPaie->setRhstructurepaie($this);
        }

        return $this;
    }

    public function removeRhBulletinPaie(RhBulletinPaie $rhBulletinPaie): self
    {
        if ($this->rhBulletinPaies->contains($rhBulletinPaie)) {
            $this->rhBulletinPaies->removeElement($rhBulletinPaie);
            // set the owning side to null (unless already changed)
            if ($rhBulletinPaie->getRhstructurepaie() === $this) {
                $rhBulletinPaie->setRhstructurepaie(null);
            }
        }

        return $this;
    }
}
