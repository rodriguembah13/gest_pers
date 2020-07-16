<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 */
class Team
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Employe", inversedBy="teams")
     */
    private $teamlead;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Employe", inversedBy="teams_members")
     */
    private $members;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Project", mappedBy="teams")
     */
    private $projects;

    public function __construct()
    {
        $this->members = new ArrayCollection();
        $this->projects = new ArrayCollection();
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

    public function getTeamlead(): ?Employe
    {
        return $this->teamlead;
    }

    public function setTeamlead(?Employe $teamlead): self
    {
        $this->teamlead = $teamlead;

        return $this;
    }

    /**
     * @return Collection|Employe[]
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function addMember(Employe $member): self
    {
        if (!$this->members->contains($member)) {
            $this->members[] = $member;
        }

        return $this;
    }

    public function removeMember(Employe $member): self
    {
        if ($this->members->contains($member)) {
            $this->members->removeElement($member);
        }

        return $this;
    }

    /**
     * @return Collection|Project[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getLibelle();
    }

}
