<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ModeratorIssueRepository")
 */
class ModeratorIssue
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $assignationDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Issue", inversedBy="moderatorIssues")
     */
    private $issue;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAssignationDate(): ?\DateTimeInterface
    {
        return $this->assignationDate;
    }

    public function setAssignationDate(?\DateTimeInterface $assignationDate): self
    {
        $this->assignationDate = $assignationDate;

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
}
