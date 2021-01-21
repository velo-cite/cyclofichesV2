<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128, unique=true)
     * @Groups({"write:issue"})
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastConnexion;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $newsletter;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="author")
     */
    private $messages;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Issue", mappedBy="liker")
     */
    private $issuesLiked;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Issue", mappedBy="creator")
     */
    private $issuesCreated;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ModeratorIssue", mappedBy="moderator")
     */
    private $issuesModerated;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Alert", mappedBy="user")
     */
    private $alerts;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Role", inversedBy="users")
     */
    private $role;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->issuesLiked = new ArrayCollection();
        $this->alerts = new ArrayCollection();
        $this->issuesCreated = new ArrayCollection();
        $this->issuesModerated = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    public function setUsername(?string $username): self
    {
        $username1 = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getLastConnexion(): ?\DateTimeInterface
    {
        return $this->lastConnexion;
    }

    public function setLastConnexion(?\DateTimeInterface $lastConnexion): self
    {
        $this->lastConnexion = $lastConnexion;

        return $this;
    }

    public function getNewsletter(): ?bool
    {
        return $this->newsletter;
    }

    public function setNewsletter(?bool $newsletter): self
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setAuthor($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getAuthor() === $this) {
                $message->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Issue[]
     */
    public function getIssuesLiked(): Collection
    {
        return $this->issuesLiked;
    }

    public function addIssue(Issue $issue): self
    {
        if (!$this->issuesLiked->contains($issue)) {
            $this->issuesLiked[] = $issue;
            $issue->addLiker($this);
        }

        return $this;
    }

    public function removeIssue(Issue $issue): self
    {
        if ($this->issuesLiked->contains($issue)) {
            $this->issuesLiked->removeElement($issue);
            $issue->removeLiker($this);
        }

        return $this;
    }

    /**
     * @return Collection|Alert[]
     */
    public function getAlerts(): Collection
    {
        return $this->alerts;
    }

    public function addAlert(Alert $alert): self
    {
        if (!$this->alerts->contains($alert)) {
            $this->alerts[] = $alert;
            $alert->setUser($this);
        }

        return $this;
    }

    public function removeAlert(Alert $alert): self
    {
        if ($this->alerts->contains($alert)) {
            $this->alerts->removeElement($alert);
            // set the owning side to null (unless already changed)
            if ($alert->getUser() === $this) {
                $alert->setUser(null);
            }
        }

        return $this;
    }

    public function addIssuesLiked(Issue $issuesLiked): self
    {
        if (!$this->issuesLiked->contains($issuesLiked)) {
            $this->issuesLiked[] = $issuesLiked;
            $issuesLiked->addLiker($this);
        }

        return $this;
    }

    public function removeIssuesLiked(Issue $issuesLiked): self
    {
        if ($this->issuesLiked->contains($issuesLiked)) {
            $this->issuesLiked->removeElement($issuesLiked);
            $issuesLiked->removeLiker($this);
        }

        return $this;
    }

    /**
     * @return Collection|Issue[]
     */
    public function getIssuesCreated(): Collection
    {
        return $this->issuesCreated;
    }

    public function addIssuesCreated(Issue $issuesCreated): self
    {
        if (!$this->issuesCreated->contains($issuesCreated)) {
            $this->issuesCreated[] = $issuesCreated;
            $issuesCreated->setCreator($this);
        }

        return $this;
    }

    public function removeIssuesCreated(Issue $issuesCreated): self
    {
        if ($this->issuesCreated->contains($issuesCreated)) {
            $this->issuesCreated->removeElement($issuesCreated);
            // set the owning side to null (unless already changed)
            if ($issuesCreated->getCreator() === $this) {
                $issuesCreated->setCreator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ModeratorIssue[]
     */
    public function getIssuesModerated(): Collection
    {
        return $this->issuesModerated;
    }

    public function addIssuesModerated(ModeratorIssue $issuesModerated): self
    {
        if (!$this->issuesModerated->contains($issuesModerated)) {
            $this->issuesModerated[] = $issuesModerated;
            $issuesModerated->setModerator($this);
        }

        return $this;
    }

    public function removeIssuesModerated(ModeratorIssue $issuesModerated): self
    {
        if ($this->issuesModerated->contains($issuesModerated)) {
            $this->issuesModerated->removeElement($issuesModerated);
            // set the owning side to null (unless already changed)
            if ($issuesModerated->getModerator() === $this) {
                $issuesModerated->setModerator(null);
            }
        }

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }


}
