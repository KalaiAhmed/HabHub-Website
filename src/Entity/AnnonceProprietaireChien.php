<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AnnonceProprietaireChien
 *
 * @ORM\Table(name="annonce_proprietaire_chien", indexes={@ORM\Index(name="idChien", columns={"idChien"})})
 * @ORM\Entity
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
     * @var \DateTime
     *
     * @ORM\Column(name="datePublication", type="date", nullable=false)
     */
    private $datepublication;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true, options={"default"="NULL"})
     */
    private $description = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=1, nullable=false)
     */
    private $type;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="datePerte", type="date", nullable=true, options={"default"="NULL"})
     */
    private $dateperte = 'NULL';

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

    /**
     * @return int
     */
    public function getIdannonceproprietairechien(): int
    {
        return $this->idannonceproprietairechien;
    }

    /**
     * @param int $idannonceproprietairechien
     */
    public function setIdannonceproprietairechien(int $idannonceproprietairechien): void
    {
        $this->idannonceproprietairechien = $idannonceproprietairechien;
    }

    /**
     * @return \DateTime
     */
    public function getDatepublication(): \DateTime
    {
        return $this->datepublication;
    }

    /**
     * @param \DateTime $datepublication
     */
    public function setDatepublication(\DateTime $datepublication): void
    {
        $this->datepublication = $datepublication;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateperte()
    {
        return $this->dateperte;
    }

    /**
     * @param \DateTime|null $dateperte
     */
    public function setDateperte($dateperte): void
    {
        $this->dateperte = $dateperte;
    }

    /**
     * @return string
     */
    public function getLocalisation(): string
    {
        return $this->localisation;
    }

    /**
     * @param string $localisation
     */
    public function setLocalisation(string $localisation): void
    {
        $this->localisation = $localisation;
    }

    /**
     * @return string|null
     */
    public function getMessagevocal(): ?string
    {
        return $this->messagevocal;
    }

    /**
     * @param string|null $messagevocal
     */
    public function setMessagevocal(?string $messagevocal): void
    {
        $this->messagevocal = $messagevocal;
    }

    /**
     * @return \Chien
     */
    public function getIdchien(): \Chien
    {
        return $this->idchien;
    }

    /**
     * @param \Chien $idchien
     */
    public function setIdchien(\Chien $idchien): void
    {
        $this->idchien = $idchien;
    }


}
