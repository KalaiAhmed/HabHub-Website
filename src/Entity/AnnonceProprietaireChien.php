<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AnnonceProprietaireChien
 *
 * @ORM\Table(name="annonce_proprietaire_chien", indexes={@ORM\Index(name="idChien", columns={"idChien"})})
 * @ORM\Entity(repositoryClass="App\Repository\AnnonceProprietaireChienRepository")
 */
class AnnonceProprietaireChien
{
    /**
     * @var int
     *
     * @ORM\Column(name="idAnnonceProprietaireChien", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idannonceproprietairechien;

    /**
     *
     *
     * @ORM\Column(name="datePublication", type="date", nullable=false)
     */
    private $datepublication;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true, options={"default"="NULL"})
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=1, nullable=false)
     */
    private $type;

    /**
     *
     *
     * @ORM\Column(name="datePerte", type="date", nullable=true, options={"default"="NULL"})
     */
    private $dateperte;

    /**
     * @var string
     *
     * @ORM\Column(name="localisation", type="string", length=250, nullable=false)
     */
    private $localisation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="messageVocal", type="string", length=250, nullable=true, options={"default"="NULL"})
     */
    private $messagevocal = 'NULL';

    /**
     * @var \Chien
     *
     * @ORM\ManyToOne(targetEntity="Chien")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idChien", referencedColumnName="idChien")
     * })
     */
    private $idchien;

    public function getIdannonceproprietairechien(): ?int
    {
        return $this->idannonceproprietairechien;
    }

    public function getDatepublication(): ?\DateTimeInterface
    {
        return $this->datepublication;
    }

    public function setDatepublication(\DateTimeInterface $datepublication): self
    {
        $this->datepublication = $datepublication;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDateperte(): ?\DateTimeInterface
    {
        return $this->dateperte;
    }

    public function setDateperte(?\DateTimeInterface $dateperte): self
    {
        $this->dateperte = $dateperte;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getMessagevocal(): ?string
    {
        return $this->messagevocal;
    }

    public function setMessagevocal(?string $messagevocal): self
    {
        $this->messagevocal = $messagevocal;

        return $this;
    }

    public function getIdchien(): ?Chien
    {
        return $this->idchien;
    }

    public function setIdchien(?Chien $idchien): self
    {
        $this->idchien = $idchien;

        return $this;
    }


}
