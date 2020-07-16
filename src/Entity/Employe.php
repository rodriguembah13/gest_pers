<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmployeRepository")
 */
class Employe
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
    private $nomComplet;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $matricule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nationalite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cni;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $passeport;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieuNaissance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $noteAdditionnelle;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Poste")
     */
    private $poste;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageFilename;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="employe", cascade={"persist", "remove"})
     */
    private $compte;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Departement", inversedBy="employes")
     */
    private $departement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $etatCivil;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sexe;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CaConge", mappedBy="employe")
     */
    private $caConges;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contrat", mappedBy="employe")
     */
    private $rhcontrats;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RhBulletinPaie", mappedBy="employe")
     */
    private $rhBulletinPaies;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AdvanceSalaire", mappedBy="employe")
     */
    private $advanceSalaires;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EtudeEmploye", mappedBy="employe")
     */
    private $etudeEmployes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ExperienceEmploye", mappedBy="employe")
     */
    private $experienceEmployes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Team", mappedBy="teamlead")
     */
    private $teams;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Team", mappedBy="members")
     */
    private $teams_members;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Timesheet", mappedBy="employe")
     */
    private $timesheets;

    public function __construct()
    {
        $this->caConges = new ArrayCollection();
        $this->rhcontrats = new ArrayCollection();
        $this->rhBulletinPaies = new ArrayCollection();
        $this->advanceSalaires = new ArrayCollection();
        $this->etudeEmployes = new ArrayCollection();
        $this->experienceEmployes = new ArrayCollection();
        $this->teams = new ArrayCollection();
        $this->teams_members = new ArrayCollection();
        $this->timesheets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomComplet(): ?string
    {
        return $this->nomComplet;
    }

    public function setNomComplet(string $nomComplet): self
    {
        $this->nomComplet = $nomComplet;

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): self
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getCni(): ?string
    {
        return $this->cni;
    }

    public function setCni(string $cni): self
    {
        $this->cni = $cni;

        return $this;
    }

    public function getPasseport(): ?string
    {
        return $this->passeport;
    }

    public function setPasseport(string $passeport): self
    {
        $this->passeport = $passeport;

        return $this;
    }

    public function getLieuNaissance(): ?string
    {
        return $this->lieuNaissance;
    }

    public function setLieuNaissance(string $lieuNaissance): self
    {
        $this->lieuNaissance = $lieuNaissance;

        return $this;
    }

    public function getNoteAdditionnelle(): ?string
    {
        return $this->noteAdditionnelle;
    }

    public function setNoteAdditionnelle(string $noteAdditionnelle): self
    {
        $this->noteAdditionnelle = $noteAdditionnelle;

        return $this;
    }

    public function getPoste(): ?Poste
    {
        return $this->poste;
    }

    public function setPoste(?Poste $poste): self
    {
        $this->poste = $poste;

        return $this;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->nomComplet;
    }

    public function getImageFilename(): ?string
    {
        return $this->imageFilename;
    }

    public function setImageFilename(?string $imageFilename): self
    {
        $this->imageFilename = $imageFilename;

        return $this;
    }

    public function getCompte(): ?User
    {
        return $this->compte;
    }

    public function setCompte(?User $compte): self
    {
        $this->compte = $compte;

        return $this;
    }

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    public function getEtatCivil(): ?string
    {
        return $this->etatCivil;
    }

    public function setEtatCivil(?string $etatCivil): self
    {
        $this->etatCivil = $etatCivil;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(?\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(?string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * @return Collection|CaConge[]
     */
    public function getCaConges(): Collection
    {
        return $this->caConges;
    }

    public function addCaConge(CaConge $caConge): self
    {
        if (!$this->caConges->contains($caConge)) {
            $this->caConges[] = $caConge;
            $caConge->setEmploye($this);
        }

        return $this;
    }

    public function removeCaConge(CaConge $caConge): self
    {
        if ($this->caConges->contains($caConge)) {
            $this->caConges->removeElement($caConge);
            // set the owning side to null (unless already changed)
            if ($caConge->getEmploye() === $this) {
                $caConge->setEmploye(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Contrat[]
     */
    public function getRhcontrats(): Collection
    {
        return $this->rhcontrats;
    }

    public function addContrat(Contrat $contrat): self
    {
        if (!$this->rhcontrats->contains($contrat)) {
            $this->rhcontrats[] = $contrat;
            $contrat->setEmploye($this);
        }

        return $this;
    }

    public function removeContrat(Contrat $contrat): self
    {
        if ($this->rhcontrats->contains($contrat)) {
            $this->rhcontrats->removeElement($contrat);
            // set the owning side to null (unless already changed)
            if ($contrat->getEmploye() === $this) {
                $contrat->setEmploye(null);
            }
        }

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
            $rhBulletinPaie->setEmploye($this);
        }

        return $this;
    }

    public function removeRhBulletinPaie(RhBulletinPaie $rhBulletinPaie): self
    {
        if ($this->rhBulletinPaies->contains($rhBulletinPaie)) {
            $this->rhBulletinPaies->removeElement($rhBulletinPaie);
            // set the owning side to null (unless already changed)
            if ($rhBulletinPaie->getEmploye() === $this) {
                $rhBulletinPaie->setEmploye(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AdvanceSalaire[]
     */
    public function getAdvanceSalaires(): Collection
    {
        return $this->advanceSalaires;
    }

    public function addAdvanceSalaire(AdvanceSalaire $advanceSalaire): self
    {
        if (!$this->advanceSalaires->contains($advanceSalaire)) {
            $this->advanceSalaires[] = $advanceSalaire;
            $advanceSalaire->setEmploye($this);
        }

        return $this;
    }

    public function removeAdvanceSalaire(AdvanceSalaire $advanceSalaire): self
    {
        if ($this->advanceSalaires->contains($advanceSalaire)) {
            $this->advanceSalaires->removeElement($advanceSalaire);
            // set the owning side to null (unless already changed)
            if ($advanceSalaire->getEmploye() === $this) {
                $advanceSalaire->setEmploye(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|EtudeEmploye[]
     */
    public function getEtudeEmployes(): Collection
    {
        return $this->etudeEmployes;
    }

    public function addEtudeEmploye(EtudeEmploye $etudeEmploye): self
    {
        if (!$this->etudeEmployes->contains($etudeEmploye)) {
            $this->etudeEmployes[] = $etudeEmploye;
            $etudeEmploye->setEmploye($this);
        }

        return $this;
    }

    public function removeEtudeEmploye(EtudeEmploye $etudeEmploye): self
    {
        if ($this->etudeEmployes->contains($etudeEmploye)) {
            $this->etudeEmployes->removeElement($etudeEmploye);
            // set the owning side to null (unless already changed)
            if ($etudeEmploye->getEmploye() === $this) {
                $etudeEmploye->setEmploye(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ExperienceEmploye[]
     */
    public function getExperienceEmployes(): Collection
    {
        return $this->experienceEmployes;
    }

    public function addExperienceEmploye(ExperienceEmploye $experienceEmploye): self
    {
        if (!$this->experienceEmployes->contains($experienceEmploye)) {
            $this->experienceEmployes[] = $experienceEmploye;
            $experienceEmploye->setEmploye($this);
        }

        return $this;
    }

    public function removeExperienceEmploye(ExperienceEmploye $experienceEmploye): self
    {
        if ($this->experienceEmployes->contains($experienceEmploye)) {
            $this->experienceEmployes->removeElement($experienceEmploye);
            // set the owning side to null (unless already changed)
            if ($experienceEmploye->getEmploye() === $this) {
                $experienceEmploye->setEmploye(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Team[]
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): self
    {
        if (!$this->teams->contains($team)) {
            $this->teams[] = $team;
            $team->setTeamlead($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teams->contains($team)) {
            $this->teams->removeElement($team);
            // set the owning side to null (unless already changed)
            if ($team->getTeamlead() === $this) {
                $team->setTeamlead(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Team[]
     */
    public function getTeamsMembers(): Collection
    {
        return $this->teams_members;
    }

    public function addTeamsMember(Team $teamsMember): self
    {
        if (!$this->teams_members->contains($teamsMember)) {
            $this->teams_members[] = $teamsMember;
            $teamsMember->addMember($this);
        }

        return $this;
    }

    public function removeTeamsMember(Team $teamsMember): self
    {
        if ($this->teams_members->contains($teamsMember)) {
            $this->teams_members->removeElement($teamsMember);
            $teamsMember->removeMember($this);
        }

        return $this;
    }

    /**
     * @return Collection|Timesheet[]
     */
    public function getTimesheets(): Collection
    {
        return $this->timesheets;
    }

    public function addTimesheet(Timesheet $timesheet): self
    {
        if (!$this->timesheets->contains($timesheet)) {
            $this->timesheets[] = $timesheet;
            $timesheet->setEmploye($this);
        }

        return $this;
    }

    public function removeTimesheet(Timesheet $timesheet): self
    {
        if ($this->timesheets->contains($timesheet)) {
            $this->timesheets->removeElement($timesheet);
            // set the owning side to null (unless already changed)
            if ($timesheet->getEmploye() === $this) {
                $timesheet->setEmploye(null);
            }
        }

        return $this;
    }
}
