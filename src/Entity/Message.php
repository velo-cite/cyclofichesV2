<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="messages")
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Issue", inversedBy="messages")
     */
    private $issue;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $creationdate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $visibility;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Picture", inversedBy="messages")
     */
    private $picture;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Alert", mappedBy="message")
     */
    private $alerts;

    public function __construct()
    {
        $this->picture = new ArrayCollection();
        $this->alerts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getIssue(): ?Issue
    {
        return $this->issue;
    }

    public function setIssue(?Issue $issue): self
    {
        $this->issue = $issue;

        return $this;
    }

    public function getCreationdate(): ?\DateTimeInterface
    {
        return $this->creationdate;
    }

    public function setCreationdate(?\DateTimeInterface $creationdate): self
    {
        $this->creationdate = $creationdate;

        return $this;
    }

    public function getVisibility(): ?string
    {
        return $this->visibility;
    }

    public function setVisibility(?string $visibility): self
    {
        $this->visibility = $visibility;

        return $this;
    }

    /**
     * @return Collection|Picture[]
     */
    public function getPicture(): Collection
    {
        return $this->picture;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->picture->contains($picture)) {
            $this->picture[] = $picture;
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->picture->contains($picture)) {
            $this->picture->removeElement($picture);
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
            $alert->setMessage($this);
        }

        return $this;
    }

    public function removeAlert(Alert $alert): self
    {
        if ($this->alerts->contains($alert)) {
            $this->alerts->removeElement($alert);
            // set the owning side to null (unless already changed)
            if ($alert->getMessage() === $this) {
                $alert->setMessage(null);
            }
        }

        return $this;
    }
}
