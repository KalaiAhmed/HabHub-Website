<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Message
 *
 * @ORM\Table(name="message", indexes={@ORM\Index(name="sender", columns={"sender"}), @ORM\Index(name="recipient", columns={"recipient"})})
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
{
    /**
     * @var int
     *
     * @ORM\Column(name="idMessage", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmessage;

    /**
     * @var string
     *@Assert\NotBlank(message=" champ obligatoire")
     *@Assert\Length(
     *      min = 3,
     *      minMessage=" au moin 3 caractéres"
     *
     *     )
     * @ORM\Column(name="title", type="string", length=20, nullable=false)
     */
    private $title;

    /**
     * @var string
     *@Assert\NotBlank(message=" champ obligatoire")
     *@Assert\Length(
     *      min = 3,
     *      minMessage=" au moin 3 caractéres"
     *
     *     )
     * @ORM\Column(name="message", type="text", length=65535, nullable=false)
     */
    private $message;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_read", type="boolean", nullable=false)
     */
    private $isRead;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="date", nullable=false)
     */
    private $createdAt;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sender", referencedColumnName="idUtilisateur")
     * })
     */
    private $sender;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="recipient", referencedColumnName="idUtilisateur")
     * })
     */
    private $recipient;

    public function getIdmessage(): ?int
    {
        return $this->idmessage;
    }

    public function getCreatedat(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedat(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function geTtitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

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

    public function getIsRead(): ?bool
    {
        return $this->isRead;
    }

    public function setIsRead(?bool $isRead): self
    {
        $this->isRead = $isRead;

        return $this;
    }

    public function getSender(): ?Utilisateur
    {
        return $this->sender;
    }

    public function setSender(?Utilisateur $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    public function getRecipient(): ?Utilisateur
    {
        return $this->recipient;
    }

    public function setRecipient(?Utilisateur $recipient): self
    {
        $this->recipient = $recipient;

        return $this;
    }


}
