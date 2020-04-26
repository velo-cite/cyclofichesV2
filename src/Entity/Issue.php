<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\IssueRepository")
 */
class Issue
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
    private $code;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $creation_date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adress;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ModeratorIssue", mappedBy="issue")
     */
    private $moderatorIssues;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="issue")
     */
    private $messages;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Area", inversedBy="issues")
     */
    private $area;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Picture", inversedBy="issues")
     */
    private $picture;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="issues")
     */
    private $liker;

    public function __construct()
    {
        $this->moderatorIssues = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->area = new ArrayCollection();
        $this->liker = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(?\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(?string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * @return Collection|ModeratorIssue[]
     */
    public function getModeratorIssues(): Collection
    {
        return $this->moderatorIssues;
    }

    public function addModeratorIssue(ModeratorIssue $moderatorIssue): self
    {
        if (!$this->moderatorIssues->contains($moderatorIssue)) {
            $this->moderatorIssues[] = $moderatorIssue;
            $moderatorIssue->setIssue($this);
        }

        return $this;
    }

    public function removeModeratorIssue(ModeratorIssue $moderatorIssue): self
    {
        if ($this->moderatorIssues->contains($moderatorIssue)) {
            $this->moderatorIssues->removeElement($moderatorIssue);
            // set the owning side to null (unless already changed)
            if ($moderatorIssue->getIssue() === $this) {
                $moderatorIssue->setIssue(null);
            }
        }

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
            $message->setIssue($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getIssue() === $this) {
                $message->setIssue(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Area[]
     */
    public function getArea(): Collection
    {
        return $this->area;
    }

    public function addArea(Area $area): self
    {
        if (!$this->area->contains($area)) {
            $this->area[] = $area;
        }

        return $this;
    }

    public function removeArea(Area $area): self
    {
        if ($this->area->contains($area)) {
            $this->area->removeElement($area);
        }

        return $this;
    }

    public function getPicture(): ?Picture
    {
        return $this->picture;
    }

    public function setPicture(?Picture $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getLiker(): Collection
    {
        return $this->liker;
    }

    public function addLiker(User $liker): self
    {
        if (!$this->liker->contains($liker)) {
            $this->liker[] = $liker;
        }

        return $this;
    }

    public function removeLiker(User $liker): self
    {
        if ($this->liker->contains($liker)) {
            $this->liker->removeElement($liker);
        }

        return $this;
    }
}
