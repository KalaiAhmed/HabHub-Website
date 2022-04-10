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
     * @ORM\Column(name="dateReservation", type="date", nullable=false)
     */
    private $datereservation;

    /**
     * @var string
     *
     * @ORM\Column(name="heureReservation", type="string", length=10, nullable=false)
     */
    private $heurereservation;

    /**
     * @var \Individu
     *
     * @ORM\ManyToOne(targetEntity="Individu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idIndividu", referencedColumnName="idIndividu")
     * })
     */
    private $idindividu;

    public function getIdreservation(): ?int
    {
        return $this->idreservation;
    }

    public function getIdbusinessservices(): ?int
    {
        return $this->idbusinessservices;
    }

    public function setIdbusinessservices(int $idbusinessservices): self
    {
        $this->idbusinessservices = $idbusinessservices;

        return $this;
    }

    public function getDatereservation(): ?\DateTimeInterface
    {
        return $this->datereservation;
    }

    public function setDatereservation(\DateTimeInterface $datereservation): self
    {
        $this->datereservation = $datereservation;

        return $this;
    }

    public function getHeurereservation(): ?string
    {
        return $this->heurereservation;
    }

    public function setHeurereservation(string $heurereservation): self
    {
        $this->heurereservation = $heurereservation;

        return $this;
    }

    public function getIdindividu(): ?Individu
    {
        return $this->idindividu;
    }

    public function setIdindividu(?Individu $idindividu): self
    {
        $this->idindividu = $idindividu;

        return $this;
    }


}
