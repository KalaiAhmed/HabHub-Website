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

    /**
     * @return int
     */
    public function getIdrevue(): int
    {
        return $this->idrevue;
    }

    /**
     * @param int $idrevue
     */
    public function setIdrevue(int $idrevue): void
    {
        $this->idrevue = $idrevue;
    }

    /**
     * @return int
     */
    public function getNbetoiles(): int
    {
        return $this->nbetoiles;
    }

    /**
     * @param int $nbetoiles
     */
    public function setNbetoiles(int $nbetoiles): void
    {
        $this->nbetoiles = $nbetoiles;
    }

    /**
     * @return string
     */
    public function getCommentaire(): string
    {
        return $this->commentaire;
    }

    /**
     * @param string $commentaire
     */
    public function setCommentaire(string $commentaire): void
    {
        $this->commentaire = $commentaire;
    }

    /**
     * @return \DateTime|null
     */
    public function getDatepublication()
    {
        return $this->datepublication;
    }

    /**
     * @param \DateTime|null $datepublication
     */
    public function setDatepublication($datepublication): void
    {
        $this->datepublication = $datepublication;
    }

    /**
     * @return \Produit
     */
    public function getIdproduit(): \Produit
    {
        return $this->idproduit;
    }

    /**
     * @param \Produit $idproduit
     */
    public function setIdproduit(\Produit $idproduit): void
    {
        $this->idproduit = $idproduit;
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
     * @return \Business
     */
    public function getIdbusiness(): \Business
    {
        return $this->idbusiness;
    }

    /**
     * @param \Business $idbusiness
     */
    public function setIdbusiness(\Business $idbusiness): void
    {
        $this->idbusiness = $idbusiness;
    }


}
