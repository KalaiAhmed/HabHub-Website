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


}
