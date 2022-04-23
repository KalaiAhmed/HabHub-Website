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
     * @ORM\Column(name="datePublication", type="date", nullable=true, options={"default"="DATE DEFAULT CURRENT_DATE"})
     */
    private $datepublication ;

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
     * @var \App\Entity\Business
     *
     * @ORM\ManyToOne(targetEntity="Business")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idBusiness", referencedColumnName="idBusiness")
     * })
     */
    private $idbusiness;

    /**
     * @param int $idrevue
     * @param int $nbetoiles
     * @param string $commentaire
     * @param \DateTime|string|null $datepublication
     * @param \Individu $idindividu
     * @param \Business $idbusiness
     */
    /*    public function __construct(int $idrevue, int $nbetoiles, string $commentaire,  \App\Entity\Business $idbusiness)


    public function __construct(int $idrevue, int $nbetoiles, string $commentaire,  Business $idbusiness)
    {
        $this->idrevue = $idrevue;
        $this->nbetoiles = $nbetoiles;
        $this->commentaire = $commentaire;
        $this->idbusiness = $idbusiness;
    }
*/
    public function getIdrevue(): ?int
    {
        return $this->idrevue;
    }

    public function getNbetoiles(): ?int
    {
        return $this->nbetoiles;
    }

    public function setNbetoiles(int $nbetoiles): self
    {
        $this->nbetoiles = $nbetoiles;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getDatepublication(): ?\DateTimeInterface
    {
        return $this->datepublication;
    }

    public function setDatepublication(?\DateTimeInterface $datepublication): self
    {
        $this->datepublication = $datepublication;

        return $this;
    }

    public function getIdproduit(): ?Produit
    {
        return $this->idproduit;
    }

    public function setIdproduit(?Produit $idproduit): self
    {
        $this->idproduit = $idproduit;

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

    public function getIdbusiness(): ?Business
    {
        return $this->idbusiness;
    }

    public function setIdbusiness(?Business $idbusiness): self
    {
        $this->idbusiness = $idbusiness;

        return $this;
    }


}
