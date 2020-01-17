<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\RhlignereglestructureRepository")
 */
class Rhlignereglestructure
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Rhstructuresalaire", inversedBy="rhlignereglestructures")
     */
    private $rhstructuresalaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rhreglesalaire", inversedBy="rhlignereglestructures")
     */
    private $rhreglesalaire;

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

    public function getRhstructuresalaire(): ?Rhstructuresalaire
    {
        return $this->rhstructuresalaire;
    }

    public function setRhstructuresalaire(?Rhstructuresalaire $rhstructuresalaire): self
    {
        $this->rhstructuresalaire = $rhstructuresalaire;

        return $this;
    }

    public function getRhreglesalaire(): ?Rhreglesalaire
    {
        return $this->rhreglesalaire;
    }

    public function setRhreglesalaire(?Rhreglesalaire $rhreglesalaire): self
    {
        $this->rhreglesalaire = $rhreglesalaire;

        return $this;
    }
}
