<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Magasin
 *
 * @ORM\Table(name="magasin", indexes={@ORM\Index(name="fk_magasin_utilisateur", columns={"idUtilisateur"})})
 * @ORM\Entity
 */
class Magasin
{
    /**
     * @var int
     *
     * @ORM\Column(name="idMagasin", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmagasin;

    /**
     * @var string
     *
     * @ORM\Column(name="nomMagasin", type="string", length=30, nullable=false)
     */
    private $nommagasin;

    /**
     * @var string
     *
     * @ORM\Column(name="nomGestionnaireMagasin", type="string", length=50, nullable=false)
     */
    private $nomgestionnairemagasin;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=100, nullable=false)
     */
    private $adresse;

    /**
     * @var int
     *
     * @ORM\Column(name="codePostal", type="integer", nullable=false)
     */
    private $codepostal;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=20, nullable=false)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="nomRepLegal", type="string", length=50, nullable=false)
     */
    private $nomreplegal;

    /**
     * @var int
     *
     * @ORM\Column(name="cinRepLegal", type="integer", nullable=false)
     */
    private $cinreplegal;

    /**
     * @var string
     *
     * @ORM\Column(name="matriculeFiscale", type="string", length=15, nullable=false)
     */
    private $matriculefiscale;

    /**
     * @var string
     *
     * @ORM\Column(name="identifiantFiscal", type="string", length=20, nullable=false)
     */
    private $identifiantfiscal;

    /**
     * @var binary|null
     *
     * @ORM\Column(name="patente", type="binary", nullable=true, options={"default"="NULL"})
     */
    private $patente = 'NULL';

    /**
     * @var int
     *
     * @ORM\Column(name="RIB", type="integer", nullable=false)
     */
    private $rib;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUtilisateur", referencedColumnName="idUtilisateur")
     * })
     */
    private $idutilisateur;


}
