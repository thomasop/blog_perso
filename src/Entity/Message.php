<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MessageRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank(message: "Ce champ est requis !")]
    private $content;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'send')]
    #[ORM\JoinColumn(nullable: false)]
    private $send;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'receive')]
    #[ORM\JoinColumn(nullable: false)]
    private $receive;

    public function __construct()
    {
        $this->createdAt = new DateTime('now');
    }
    
    public function __toString() {
        return $this->content;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getSend(): ?User
    {
        return $this->send;
    }

    public function setSend(?User $send): self
    {
        $this->send = $send;

        return $this;
    }

    public function getReceive(): ?User
    {
        return $this->receive;
    }

    public function setReceive(?User $receive): self
    {
        $this->receive = $receive;

        return $this;
    }
}