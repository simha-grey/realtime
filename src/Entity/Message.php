<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
#[ORM\Index(columns: ["created_at"], name: "created_at_index")]
#[ORM\HasLifecycleCallbacks()]
class Message
{
    use Timestamp;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "text")]
    private string $content;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "messages")]
    private User $user;

    #[ORM\ManyToOne(targetEntity: Conversation::class, inversedBy: "messages")]
    private Conversation $conversation;
    private mixed $mine;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getConversation(): ?Conversation
    {
        return $this->conversation;
    }

    public function setConversation(?Conversation $conversation): self
    {
        $this->conversation = $conversation;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMine(): mixed
    {
        return $this->mine;
    }

    /**
     * @param mixed $mine
     */
    public function setMine(mixed $mine): void
    {
        $this->mine = $mine;
    }
}
