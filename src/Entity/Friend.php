<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FriendRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FriendRepository::class)]
class Friend
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'boolean')]
    private $statut;

    #[ORM\Column(type: 'datetime', nullable: true)]
    #[Assert\DateTime]
    private $friendAt;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'expediteur')]
    #[ORM\JoinColumn(nullable: false)]
    private $send;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'destinataire')]
    #[ORM\JoinColumn(nullable: false)]
    private $receive;

    public function __construct()
    {
        $this->statut = 0;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatut(): ?bool
    {
        return $this->statut;
    }

    public function setStatut(bool $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getFriendAt(): ?\DateTimeInterface
    {
        return $this->friendAt;
    }

    public function setFriendAt(?\DateTimeInterface $friendAt): self
    {
        $this->friendAt = $friendAt;

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
