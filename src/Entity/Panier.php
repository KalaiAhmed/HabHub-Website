<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Panier
 *
 * @ORM\Table(name="panier", indexes={@ORM\Index(name="fk_panier_utilisateur", columns={"idUtilisateur"}), @ORM\Index(name="idProduit", columns={"idProduit"})})
 * @ORM\Entity
 */
class Panier
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPanier", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpanier;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var \Individu
     *
     * @ORM\ManyToOne(targetEntity="Individu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUtilisateur", referencedColumnName="idUtilisateur")
     * })
     */
    private $idutilisateur;

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
     * @return int
     */
    public function getIdpanier(): int
    {
        return $this->idpanier;
    }

    /**
     * @param int $idpanier
     */
    public function setIdpanier(int $idpanier): void
    {
        $this->idpanier = $idpanier;
    }

    /**
     * @return int
     */
    public function getQuantite(): int
    {
        return $this->quantite;
    }

    /**
     * @param int $quantite
     */
    public function setQuantite(int $quantite): void
    {
        $this->quantite = $quantite;
    }

    /**
     * @return \Individu
     */
    public function getIdutilisateur(): \Individu
    {
        return $this->idutilisateur;
    }

    /**
     * @param \Individu $idutilisateur
     */
    public function setIdutilisateur(\Individu $idutilisateur): void
    {
        $this->idutilisateur = $idutilisateur;
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


}
