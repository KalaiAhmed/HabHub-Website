<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation", indexes={@ORM\Index(name="fk_reservation_businessServices", columns={"idBusinessServices"}), @ORM\Index(name="fk_reservation_individu", columns={"idIndividu"})})
 * @ORM\Entity
 */
class Reservation
{
    /**
     * @var int
     *
     * @ORM\Column(name="idReservation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreservation;

    /**
     * @var int
     *
     * @ORM\Column(name="idBusinessServices", type="integer", nullable=false)
     */
    private $idbusinessservices;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateHeureDebut", type="datetime", nullable=false)
     */
    private $dateheuredebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateHeureFin", type="datetime", nullable=false)
     */
    private $dateheurefin;

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
     * @return int
     */
    public function getIdreservation(): int
    {
        return $this->idreservation;
    }

    /**
     * @param int $idreservation
     */
    public function setIdreservation(int $idreservation): void
    {
        $this->idreservation = $idreservation;
    }

    /**
     * @return int
     */
    public function getIdbusinessservices(): int
    {
        return $this->idbusinessservices;
    }

    /**
     * @param int $idbusinessservices
     */
    public function setIdbusinessservices(int $idbusinessservices): void
    {
        $this->idbusinessservices = $idbusinessservices;
    }

    /**
     * @return \DateTime
     */
    public function getDateheuredebut(): \DateTime
    {
        return $this->dateheuredebut;
    }

    /**
     * @param \DateTime $dateheuredebut
     */
    public function setDateheuredebut(\DateTime $dateheuredebut): void
    {
        $this->dateheuredebut = $dateheuredebut;
    }

    /**
     * @return \DateTime
     */
    public function getDateheurefin(): \DateTime
    {
        return $this->dateheurefin;
    }

    /**
     * @param \DateTime $dateheurefin
     */
    public function setDateheurefin(\DateTime $dateheurefin): void
    {
        $this->dateheurefin = $dateheurefin;
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


}
