<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table(name="image", indexes={@ORM\Index(name="fk_image_chien", columns={"idChien"}), @ORM\Index(name="idProduit", columns={"idProduit", "idUtilisateur", "idChien"}), @ORM\Index(name="fk_image_utilisateur", columns={"idUtilisateur"}), @ORM\Index(name="IDX_C53D045F391C87D5", columns={"idProduit"})})
 * @ORM\Entity
 */
class Image
{
    /**
     * @var int
     *
     * @ORM\Column(name="idImage", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idimage;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=200, nullable=false)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=1, nullable=false)
     */
    private $type;

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
     * @var \Chien
     *
     * @ORM\ManyToOne(targetEntity="Chien")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idChien", referencedColumnName="idChien")
     * })
     */
    private $idchien;

    /**
     * @return int
     */
    public function getIdimage(): int
    {
        return $this->idimage;
    }

    /**
     * @param int $idimage
     */
    public function setIdimage(int $idimage): void
    {
        $this->idimage = $idimage;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
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

    /**
     * @return \Chien
     */
    public function getIdchien(): \Chien
    {
        return $this->idchien;
    }

    /**
     * @param \Chien $idchien
     */
    public function setIdchien(\Chien $idchien): void
    {
        $this->idchien = $idchien;
    }


}
