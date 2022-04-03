<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Revue
 *
 * @ORM\Table(name="revue", indexes={@ORM\Index(name="idIndividu", columns={"idIndividu"}), @ORM\Index(name="idProduit", columns={"idProduit"}), @ORM\Index(name="idBusiness", columns={"idBusiness"})})
 * @ORM\Entity
 */
class Revue
{
    /**
     * @var int
     *
     * @ORM\Column(name="idRevue", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrevue;

    /**
     * @var int
     *
     * @ORM\Column(name="nbEtoiles", type="integer", nullable=false)
     */
    private $nbetoiles;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=500, nullable=false)
     */
    private $commentaire;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="datePublication", type="date", nullable=true, options={"default"="NULL"})
     */
    private $datepublication = 'NULL';

    /**
     * @var \Produit
     *
     * @ORM\ManyToOne(targetEntity="Produit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idProduit", referencedColumnName="idProduit")
     * })
     */
    private $idproduit;

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
     * @var \Business
     *
     * @ORM\ManyToOne(targetEntity="Business")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idBusiness", referencedColumnName="idBusiness")
     * })
     */
    private $idbusiness;


}
