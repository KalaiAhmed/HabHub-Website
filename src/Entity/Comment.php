<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Comment
 *
 * @ORM\Table(name="comment", indexes={@ORM\Index(name="idIndividu", columns={"idIndividu"}), @ORM\Index(name="idAnnonceAdoption", columns={"idAnnonceAdoption"})})
 * @ORM\Entity
 */
class Comment
{
    /**
     * @var int
     *
     * @ORM\Column(name="idComment", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcomment;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="date", nullable=false)
     */
    private $createdAt;

    /**
     * @var string
     *@Assert\NotBlank(message=" champ obligatoire")
     *
     * @ORM\Column(name="content", type="text", length=65535, nullable=false)
     */
    private $content;

    /**
     * @var \AnnonceAdoption
     *
     * @ORM\ManyToOne(targetEntity="AnnonceAdoption")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idAnnonceAdoption", referencedColumnName="idAnnonceAdoption")
     * })
     */
    private $idannonceadoption;

    /**
     * @var \Individu
     *
     * @ORM\ManyToOne(targetEntity="Individu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idIndividu", referencedColumnName="idIndividu")
     * })
     */
    private $idindividu;

    public function getIdcomment(): ?int
    {
        return $this->idcomment;
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }


    public function getIdindividu(): ?Individu
    {
        return $this->idindividu;
    }

    public function setIdindividu(?Individu $individu): self
    {
        $this->individu = $individu;

        return $this;
    }

    public function getIdannonceadoption(): ?AnnonceAdoption
    {
        return $this->idannonceadoption;
    }

    public function setIdannonceadoption(?AnnonceAdoption $idannonceadoption): self
    {
        $this->idannonceadoption = $idannonceadoption;

        return $this;
    }


}
