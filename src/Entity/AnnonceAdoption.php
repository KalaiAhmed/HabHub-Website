<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AnnonceAdoption
 *
 * @ORM\Table(name="annonce_adoption", indexes={@ORM\Index(name="fk_annonceAdoption_chien", columns={"idChien"}), @ORM\Index(name="idIndividu", columns={"idIndividu"})})
 * @ORM\Entity
 */
class AnnonceAdoption
{
    /**
     * @var int
     *
     * @ORM\Column(name="idAnnonceAdoption", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idannonceadoption;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePublication", type="date", nullable=false)
     */
    private $datepublication;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=200, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="localisation", type="string", length=50, nullable=false)
     */
    private $localisation;

    /**
     * @var \Individu
     *
     * @ORM\ManyToOne(targetEntity="Individu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idIndividu", referencedColumnName="idIndividu")
     * })
     */
    private $idindividu;

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
    public function getIdannonceadoption(): int
    {
        return $this->idannonceadoption;
    }

    /**
     * @param int $idannonceadoption
     */
    public function setIdannonceadoption(int $idannonceadoption): void
    {
        $this->idannonceadoption = $idannonceadoption;
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
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
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
     * @return \Individu
     */
    public function getIdindividu(): \Individu
    {
        return $this->idindividu;
    }

    /**
     * @param \Individu $idindividu
     */
    public function setIdindividu(\Individu $idindividu): void
    {
        $this->idindividu = $idindividu;
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
