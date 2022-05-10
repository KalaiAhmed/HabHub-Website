<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Produit
 *
 * @ORM\Table(name="produit", indexes={@ORM\Index(name="idCategorie", columns={"idCategorie"})})
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 */
class Produit
{
    /**
     * @var int
     *
     * @ORM\Column(name="idProduit", type="integer", nullable=false)
     * @ORM\Id 
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idproduit;

    /**
     * @var string
     * @Assert\NotBlank(message=" nom doit etre non vide")
     * @ORM\Column(name="nom", type="string", length=20, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *@Assert\Length(
     *      min = 3,
     *      minMessage=" au moin 3 caractéres"
     *
     *     )
     * @ORM\Column(name="description", type="string", length=500, nullable=false)
     */
    private $description;

    /**
     * @var float
     * @Assert\NotBlank(message=" prix doit etre non vide")
     * @ORM\Column(name="prix", type="integer", nullable=false)
     */
    private $prix;

    /**
     * @var string
     * @Assert\NotBlank(message=" marque doit etre non vide")
     * @ORM\Column(name="marque", type="string", length=50, nullable=false)
     */
    private $marque;

    /**
     * @var int|null
     * @Assert\NotBlank(message=" nbetoiles doit etre non vide")
     * @ORM\Column(name="nbEtoiles", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $nbetoiles = NULL;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=30, nullable=true, options={"default"="NULL"})
     */
    private $image = 'NULL';

    /**
     * @var \Categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCategorie", referencedColumnName="idCategorie")
     * })
     */
    private $idcategorie;

    public function getIdproduit(): ?int
    {
        return $this->idproduit;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getNbetoiles(): ?int
    {
        return $this->nbetoiles;
    }

    public function setNbetoiles(?int $nbetoiles): self
    {
        $this->nbetoiles = $nbetoiles;
      

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getIdcategorie(): ?Categorie
    {
        return $this->idcategorie;
    }

    public function setIdcategorie(?Categorie $idcategorie): self
    {
        $this->idcategorie = $idcategorie;

        return $this;
    }


}
