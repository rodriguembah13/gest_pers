<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\RhlignereglepaieRepository")
 */
class Rhlignereglepaie
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $total;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\RhBulletinPaie", inversedBy="rhlignereglepaies")
     */
    private $rhBulletinPaie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rhreglesalaire", inversedBy="rhlignereglepaies")
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

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(?float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getRhBulletinPaie(): ?RhBulletinPaie
    {
        return $this->rhBulletinPaie;
    }

    public function setRhBulletinPaie(?RhBulletinPaie $rhBulletinPaie): self
    {
        $this->rhBulletinPaie = $rhBulletinPaie;

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
    public function __toString()
    {
        return $this->libelle;
    }
}
