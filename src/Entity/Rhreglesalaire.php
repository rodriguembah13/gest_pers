<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\RhreglesalaireRepository")
 */
class Rhreglesalaire
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sequencecalcul;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isvisible;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pourcentage;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $montantfixe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $registrecontribution;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $plagemin;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $plagemax;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $plagesur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pourcentagesur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $codecalcul;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rhcondition;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typecondition;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $expression;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\RhCategorieRegle", inversedBy="rhreglesalaires")
     */
    private $rhcategorieregle;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rhlignereglepaie", mappedBy="rhreglesalaire")
     */
    private $rhlignereglepaies;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rhlignereglestructure", mappedBy="rhreglesalaire")
     */
    private $rhlignereglestructures;

    public function __construct()
    {
        $this->rhlignereglepaies = new ArrayCollection();
        $this->rhlignereglestructures = new ArrayCollection();
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

    public function getSequencecalcul(): ?int
    {
        return $this->sequencecalcul;
    }

    public function setSequencecalcul(?int $sequencecalcul): self
    {
        $this->sequencecalcul = $sequencecalcul;

        return $this;
    }

    public function getIsvisible(): ?bool
    {
        return $this->isvisible;
    }

    public function setIsvisible(?bool $isvisible): self
    {
        $this->isvisible = $isvisible;

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

    public function getPourcentage(): ?int
    {
        return $this->pourcentage;
    }

    public function setPourcentage(?int $pourcentage): self
    {
        $this->pourcentage = $pourcentage;

        return $this;
    }

    public function getMontantfixe(): ?float
    {
        return $this->montantfixe;
    }

    public function setMontantfixe(?float $montantfixe): self
    {
        $this->montantfixe = $montantfixe;

        return $this;
    }

    public function getRegistrecontribution(): ?string
    {
        return $this->registrecontribution;
    }

    public function setRegistrecontribution(?string $registrecontribution): self
    {
        $this->registrecontribution = $registrecontribution;

        return $this;
    }

    public function getPlagemin(): ?int
    {
        return $this->plagemin;
    }

    public function setPlagemin(?int $plagemin): self
    {
        $this->plagemin = $plagemin;

        return $this;
    }

    public function getPlagemax(): ?int
    {
        return $this->plagemax;
    }

    public function setPlagemax(?int $plagemax): self
    {
        $this->plagemax = $plagemax;

        return $this;
    }

    public function getPlagesur(): ?string
    {
        return $this->plagesur;
    }

    public function setPlagesur(?string $plagesur): self
    {
        $this->plagesur = $plagesur;

        return $this;
    }

    public function getPourcentagesur(): ?string
    {
        return $this->pourcentagesur;
    }

    public function setPourcentagesur(?string $pourcentagesur): self
    {
        $this->pourcentagesur = $pourcentagesur;

        return $this;
    }

    public function getCodecalcul(): ?string
    {
        return $this->codecalcul;
    }

    public function setCodecalcul(?string $codecalcul): self
    {
        $this->codecalcul = $codecalcul;

        return $this;
    }

    public function getRhcondition(): ?string
    {
        return $this->rhcondition;
    }

    public function setRhcondition(?string $rhcondition): self
    {
        $this->rhcondition = $rhcondition;

        return $this;
    }

    public function getTypecondition(): ?string
    {
        return $this->typecondition;
    }

    public function setTypecondition(?string $typecondition): self
    {
        $this->typecondition = $typecondition;

        return $this;
    }

    public function getExpression(): ?string
    {
        return $this->expression;
    }

    public function setExpression(?string $expression): self
    {
        $this->expression = $expression;

        return $this;
    }

    public function getRhcategorieregle(): ?RhCategorieRegle
    {
        return $this->rhcategorieregle;
    }

    public function setRhcategorieregle(?RhCategorieRegle $rhcategorieregle): self
    {
        $this->rhcategorieregle = $rhcategorieregle;

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
            $rhlignereglepaie->setRhreglesalaire($this);
        }

        return $this;
    }

    public function removeRhlignereglepaie(Rhlignereglepaie $rhlignereglepaie): self
    {
        if ($this->rhlignereglepaies->contains($rhlignereglepaie)) {
            $this->rhlignereglepaies->removeElement($rhlignereglepaie);
            // set the owning side to null (unless already changed)
            if ($rhlignereglepaie->getRhreglesalaire() === $this) {
                $rhlignereglepaie->setRhreglesalaire(null);
            }
        }

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
            $rhlignereglestructure->setRhreglesalaire($this);
        }

        return $this;
    }

    public function removeRhlignereglestructure(Rhlignereglestructure $rhlignereglestructure): self
    {
        if ($this->rhlignereglestructures->contains($rhlignereglestructure)) {
            $this->rhlignereglestructures->removeElement($rhlignereglestructure);
            // set the owning side to null (unless already changed)
            if ($rhlignereglestructure->getRhreglesalaire() === $this) {
                $rhlignereglestructure->setRhreglesalaire(null);
            }
        }

        return $this;
    }
}
