<?php

/*
 * This file is part of the AdminLTE-Bundle demo.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Application main User entity.
 *
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(
 *      name="users",
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(columns={"username"}),
 *          @ORM\UniqueConstraint(columns={"email"})
 *      }
 * )
 * @UniqueEntity("username")
 * @UniqueEntity("email")
 */
class User extends BaseUser implements UserInterface, EquatableInterface
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     */
    protected $id;
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Group")
     * @ORM\JoinTable(name="users_user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageFilename;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Employe", mappedBy="compte", cascade={"persist", "remove"})
     */
    private $employe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatar;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AdvanceSalaire", mappedBy="user")
     */
    private $advanceSalaires;

    public function __construct()
    {
        parent::__construct();
        $this->advanceSalaires = new ArrayCollection();
    }
    /**
     * Checks if the user has to be logged out of the session,
     * due to changed fields / security related settings (like roles and teams).
     *
     * @param UserInterface $user
     * @return bool
     */
    public function isEqualTo(UserInterface $user)
    {
        if (!$user instanceof self) {
            return false;
        }

        if ($this->password !== $user->getPassword()) {
            return false;
        }

        if ($this->salt !== $user->getSalt()) {
            return false;
        }

        if ($this->username !== $user->getUsername()) {
            return false;
        }

        return true;
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

    public function getEmploye(): ?Employe
    {
        return $this->employe;
    }

    public function setEmploye(?Employe $employe): self
    {
        $this->employe = $employe;

        // set (or unset) the owning side of the relation if necessary
        $newCompte = null === $employe ? null : $this;
        if ($employe->getCompte() !== $newCompte) {
            $employe->setCompte($newCompte);
        }

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

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
            $advanceSalaire->setUser($this);
        }

        return $this;
    }

    public function removeAdvanceSalaire(AdvanceSalaire $advanceSalaire): self
    {
        if ($this->advanceSalaires->contains($advanceSalaire)) {
            $this->advanceSalaires->removeElement($advanceSalaire);
            // set the owning side to null (unless already changed)
            if ($advanceSalaire->getUser() === $this) {
                $advanceSalaire->setUser(null);
            }
        }

        return $this;
    }
}
