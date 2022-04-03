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


}
