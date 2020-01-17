<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\RhCathegorieRegleRepository")
 */
class RhCategorieRegle
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $operation;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rhreglesalaire", mappedBy="rhcategorieregle")
     */
    private $rhreglesalaires;

    public function __construct()
    {
        $this->rhreglesalaires = new ArrayCollection();
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getOperation(): ?string
    {
        return $this->operation;
    }

    public function setOperation(?string $operation): self
    {
        $this->operation = $operation;

        return $this;
    }

    /**
     * @return Collection|Rhreglesalaire[]
     */
    public function getRhreglesalaires(): Collection
    {
        return $this->rhreglesalaires;
    }

    public function addRhreglesalaire(Rhreglesalaire $rhreglesalaire): self
    {
        if (!$this->rhreglesalaires->contains($rhreglesalaire)) {
            $this->rhreglesalaires[] = $rhreglesalaire;
            $rhreglesalaire->setRhcategorieregle($this);
        }

        return $this;
    }

    public function removeRhreglesalaire(Rhreglesalaire $rhreglesalaire): self
    {
        if ($this->rhreglesalaires->contains($rhreglesalaire)) {
            $this->rhreglesalaires->removeElement($rhreglesalaire);
            // set the owning side to null (unless already changed)
            if ($rhreglesalaire->getRhcategorieregle() === $this) {
                $rhreglesalaire->setRhcategorieregle(null);
            }
        }

        return $this;
    }
}
