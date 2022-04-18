<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Business
 *
 * @ORM\Table(name="business", indexes={@ORM\Index(name="idUtilisateur", columns={"idUtilisateur"})})
 * @ORM\Entity(repositoryClass="App\Repository\BusinessRepository")
 */
class Business
{
    /**
     * @var int
     *
     * @ORM\Column(name="idBusiness", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idbusiness;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=100, nullable=false)
     */
    private $titre;

    /**
     * @var string
     * @Assert\NotBlank(message=" titre doit etre non vide")
     * @ORM\Column(name="description", type="string", length=500, nullable=false)
     */
    private $description;

    /**
     * @var string
     * @Assert\NotBlank(message=" horaire doit etre non vide")
     * @ORM\Column(name="horaire", type="string", length=10, nullable=false)
     */
    private $horaire;

    /**
     * @var string
     * @Assert\NotBlank(message=" ville doit etre non vide")
     * @ORM\Column(name="ville", type="string", length=50, nullable=false)
     */
    private $ville;

    /**
     * @var string
     * @Assert\NotBlank(message=" localisation doit etre non vide")
     * @ORM\Column(name="localisation", type="string", length=50, nullable=false)
     */
    private $localisation;

    /**
     * @var string|null
     * @Assert\NotBlank(message=" type doit etre non vide")

     * @ORM\Column(name="type", type="string", length=20, nullable=true, options={"default"="NULL"})
     */
    private $type;

    /**
     * @var int
     * @Assert\NotBlank(message=" experience doit etre non vide")

     * @ORM\Column(name="experience", type="integer", nullable=false)
     */
    private $experience;

    /**
     * @var string
      * @Assert\File(mimeTypes={"image/jpeg"})
     * @ORM\Column(name="image", type="string", length=30, nullable=false)
     */
    private $image ;

    /** 
     * @var Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUtilisateur", referencedColumnName="idUtilisateur")
     * })
     */
    private $idutilisateur;

    public function getIdbusiness(): ?int
    {
        return $this->idbusiness;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

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

    public function getHoraire(): ?string
    {
        return $this->horaire;
    }

    public function setHoraire(string $horaire): self
    {
        $this->horaire = $horaire;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function setExperience(int $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage( $image)
    {
        $this->image = $image;

        return $this;
    }

    public function getIdutilisateur(): ?Utilisateur
    {
        return $this->idutilisateur;
    }

    public function setIdutilisateur(?Utilisateur $idutilisateur): self
    {
        $this->idutilisateur = $idutilisateur;

        return $this;
    }


}
