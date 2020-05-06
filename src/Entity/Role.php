<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\RoleRepository")
 */
class Role
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="role")
     */
    private $users;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Visibility", inversedBy="roles")
     */
    private $visibilities;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Right", inversedBy="roles")
     */
    private $rights;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->visibilities = new ArrayCollection();
        $this->rights = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setRole($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getRole() === $this) {
                $user->setRole(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Visibility[]
     */
    public function getVisibilities(): Collection
    {
        return $this->visibilities;
    }

    public function addVisibility(Visibility $visibility): self
    {
        if (!$this->visibilities->contains($visibility)) {
            $this->visibilities[] = $visibility;
        }

        return $this;
    }

    public function removeVisibility(Visibility $visibility): self
    {
        if ($this->visibilities->contains($visibility)) {
            $this->visibilities->removeElement($visibility);
        }

        return $this;
    }

    /**
     * @return Collection|Right[]
     */
    public function getRights(): Collection
    {
        return $this->rights;
    }

    public function addRight(Right $right): self
    {
        if (!$this->rights->contains($right)) {
            $this->rights[] = $right;
        }

        return $this;
    }

    public function removeRight(Right $right): self
    {
        if ($this->rights->contains($right)) {
            $this->rights->removeElement($right);
        }

        return $this;
    }
}
