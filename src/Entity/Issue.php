<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource(
 *     collectionOperations={"get", "post"},
 *     itemOperations={"get"},
 *     normalizationContext={"groups"={"read:issue"}},
 *     denormalizationContext={"groups"={"write:issue"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\IssueRepository")
 * @ORM\HasLifecycleCallbacks()
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
     * @Groups({"read:issue"})
     */
    private $code;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"read:issue"})
     */
    private $creationDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("write:issue")
     * @Assert\NotBlank()
     */
    private $address;

     /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"write:issue"})
     * @Assert\NotBlank()
     * @Groups({"read:issue"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"write:issue"})
     * @Assert\NotBlank()
     * @Assert\Regex("/^(-?\d+(\.\d+)?),\s*(-?\d+(\.\d+)?)$/")
     * @Groups({"read:issue"})
     */
    private $gpsCoordinates;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ModeratorIssue", mappedBy="issue")
     */
    private $moderators;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="issue")
     */
    private $messages;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Area", inversedBy="issues")
     */
    private $area;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Picture", inversedBy="issues")
     */
    private $pictures;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="issuesLiked")
     */
    private $liker;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Status", inversedBy="issues")
     */
    private $status;

    /**
     * @ORM\Column(type="string", nullable=false, length=255)
     * @Groups({"write:issue"})
     * @Assert\NotNull()
     * @Assert\Regex("/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/")
     * @Groups({"read:issue"})
     */
    private $creatorEmail;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IssueCategory", inversedBy="issues")
     * @Groups({"write:issue"})
     * @Assert\NotNull()
     */
    private $category;

   
    public function __construct()
    {
        $this->moderators = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->liker = new ArrayCollection();
        $this->pictures = new ArrayCollection();
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
        return $this->creationDate;
    }

    public function setCreationDate(?\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection|ModeratorIssue[]
     */
    public function getModerators(): Collection
    {
        return $this->moderators;
    }

    public function addModeratorIssue(ModeratorIssue $moderatorIssue): self
    {
        if (!$this->moderators->contains($moderatorIssue)) {
            $this->moderators[] = $moderatorIssue;
            $moderatorIssue->setIssue($this);
        }

        return $this;
    }

    public function removeModeratorIssue(ModeratorIssue $moderatorIssue): self
    {
        if ($this->moderators->contains($moderatorIssue)) {
            $this->moderators->removeElement($moderatorIssue);
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

    public function getPictures(): ?Picture
    {
        return $this->pictures;
    }

    public function setPictures(?Picture $pictures): self
    {
        $this->pictures = $pictures;

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

    public function getArea(): ?Area
    {
        return $this->area;
    }

    public function setArea(?Area $area): self
    {
        $this->area = $area;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getGpsCoordinates(): ?string
    {
        return $this->gpsCoordinates;
    }

    public function setGpsCoordinates(?string $gpsCoordinates): self
    {
        $this->gpsCoordinates = $gpsCoordinates;

        return $this;
    }

    public function getCreatorEmail(): ?string
    {
        return $this->creatorEmail;
    }

    public function setCreatorEmail(?string $creatorEmail): self
    {
        $this->creatorEmail = $creatorEmail;

        return $this;
    }

    public function getCategory(): ?IssueCategory
    {
        return $this->category;
    }

    public function setCategory(?IssueCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function addModerator(ModeratorIssue $moderator): self
    {
        if (!$this->moderators->contains($moderator)) {
            $this->moderators[] = $moderator;
            $moderator->setIssue($this);
        }

        return $this;
    }

    public function removeModerator(ModeratorIssue $moderator): self
    {
        if ($this->moderators->contains($moderator)) {
            $this->moderators->removeElement($moderator);
            // set the owning side to null (unless already changed)
            if ($moderator->getIssue() === $this) {
                $moderator->setIssue(null);
            }
        }

        return $this;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->contains($picture)) {
            $this->pictures->removeElement($picture);
        }

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

    /**
     * @ORM\PrePersist() 
     */
     
    public function generateCode()
    {
        $date = new \DateTime(); 
        $this->code = "CF-". $date->format('Ymd'); 
    }
}
