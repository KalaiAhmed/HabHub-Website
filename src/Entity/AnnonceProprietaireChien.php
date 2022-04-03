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


}
