<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[Table(name: "userblog")]
#[ORM\Index(fields: ["prenom"], flags: ["fulltext"])]
#[ORM\Index(fields: ["nom"], flags: ["fulltext"])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    #[Assert\NotBlank(message: "Ce champ est requis !")]
    #[Assert\Email]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank(message: "Ce champ est requis !")]
    #[Assert\Length(min: 8, max: 255, minMessage: "Votre email ne peut pas contenir moins que {{ limit }} caractères !", maxMessage: "Votre email ne peut pas contenir plus que {{ limit }} caractères !")]
    #[Assert\Regex(pattern: "#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#", match: true, message: "Mot de passe incorrect: Une lettre en majuscule, minuscule, un chiffre et caractère speciaux attendu ainsi que 8 caractères minimum!")]
    private $password;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Comment::class, orphanRemoval: true)]
    private $comments;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Post::class, orphanRemoval: true)]
    private $posts;

    #[ORM\Column(type: 'string', length: 255)]
    private $avatar;

    #[ORM\Column(type: 'boolean')]
    private $enabled;

    #[ORM\OneToMany(mappedBy: 'send', targetEntity: Message::class, orphanRemoval: true)]
    private $send;

    #[ORM\OneToMany(mappedBy: 'receive', targetEntity: Message::class, orphanRemoval: true)]
    private $receive;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $token;

    #[ORM\OneToMany(mappedBy: 'send', targetEntity: Friend::class, orphanRemoval: true)]
    private $expediteur;

    #[ORM\OneToMany(mappedBy: 'receive', targetEntity: Friend::class, orphanRemoval: true)]
    private $destinataire;

    #[ORM\Column(type: 'boolean')]
    private $admin;

    #[ORM\Column(type: 'boolean')]
    private $demandeAdmin;

    #[ORM\Column(type: 'text', nullable: true)]
    private $message;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: "Ce champ est requis !")]
    private $prenom;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: "Ce champ est requis !")]
    private $nom;

    #[ORM\Column(type: 'date')]
    private $age;

    #[ORM\Column(type: 'boolean')]
    private $sexe;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Image::class, orphanRemoval: true)]
    private $images;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Video::class, orphanRemoval: true)]
    private $videos;

    public function __construct()
    {
        $this->roles = ['ROLE_USER'];
        $this->token = null;
        $this->enabled = false;
        $this->admin = false;
        $this->demandeAdmin = false;
        $this->message = null;
        $this->comments = new ArrayCollection();
        $this->posts = new ArrayCollection();
        $this->send = new ArrayCollection();
        $this->receive = new ArrayCollection();
        $this->expediteur = new ArrayCollection();
        $this->destinataire = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->videos = new ArrayCollection();
    }

    public function __toString() {
        return $this->prenom . $this->nom;
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
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
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
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setUser($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getUser() === $this) {
                $post->setUser(null);
            }
        }

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getSend(): Collection
    {
        return $this->send;
    }

    public function addSend(Message $send): self
    {
        if (!$this->send->contains($send)) {
            $this->send[] = $send;
            $send->setSend($this);
        }

        return $this;
    }

    public function removeSend(Message $send): self
    {
        if ($this->send->removeElement($send)) {
            // set the owning side to null (unless already changed)
            if ($send->getSend() === $this) {
                $send->setSend(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getReceive(): Collection
    {
        return $this->receive;
    }

    public function addReceive(Message $receive): self
    {
        if (!$this->receive->contains($receive)) {
            $this->receive[] = $receive;
            $receive->setReceive($this);
        }

        return $this;
    }

    public function removeReceive(Message $receive): self
    {
        if ($this->receive->removeElement($receive)) {
            // set the owning side to null (unless already changed)
            if ($receive->getReceive() === $this) {
                $receive->setReceive(null);
            }
        }

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return Collection<int, Friend>
     */
    public function getExpediteur(): Collection
    {
        return $this->expediteur;
    }

    public function addExpediteur(Friend $expediteur): self
    {
        if (!$this->expediteur->contains($expediteur)) {
            $this->expediteur[] = $expediteur;
            $expediteur->setSend($this);
        }

        return $this;
    }

    public function removeExpediteur(Friend $expediteur): self
    {
        if ($this->expediteur->removeElement($expediteur)) {
            // set the owning side to null (unless already changed)
            if ($expediteur->getSend() === $this) {
                $expediteur->setSend(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Friend>
     */
    public function getDestinataire(): Collection
    {
        return $this->destinataire;
    }

    public function addDestinataire(Friend $destinataire): self
    {
        if (!$this->destinataire->contains($destinataire)) {
            $this->destinataire[] = $destinataire;
            $destinataire->setReceive($this);
        }

        return $this;
    }

    public function removeDestinataire(Friend $destinataire): self
    {
        if ($this->destinataire->removeElement($destinataire)) {
            // set the owning side to null (unless already changed)
            if ($destinataire->getReceive() === $this) {
                $destinataire->setReceive(null);
            }
        }

        return $this;
    }

    public function getAdmin(): ?bool
    {
        return $this->admin;
    }

    public function setAdmin(bool $admin): self
    {
        $this->admin = $admin;

        return $this;
    }

    public function getDemandeAdmin(): ?bool
    {
        return $this->demandeAdmin;
    }

    public function setDemandeAdmin(bool $demandeAdmin): self
    {
        $this->demandeAdmin = $demandeAdmin;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAge(): ?\DateTimeInterface
    {
        return $this->age;
    }

    public function setAge(?\DateTimeInterface $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getSexe(): ?bool
    {
        return $this->sexe;
    }

    public function setSexe(?bool $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setUser($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getUser() === $this) {
                $image->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Video>
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->videos->contains($video)) {
            $this->videos[] = $video;
            $video->setUser($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->videos->removeElement($video)) {
            // set the owning side to null (unless already changed)
            if ($video->getUser() === $this) {
                $video->setUser(null);
            }
        }

        return $this;
    }
}