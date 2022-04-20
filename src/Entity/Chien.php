<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Chien
 *
 * @ORM\Table(name="chien", indexes={@ORM\Index(name="idIndividu", columns={"idIndividu"})})
@ORM\Entity(repositoryClass="App\Repository\ChienRepository")
 */
class Chien
{
    /**
     * @var int
     *
     * @ORM\Column(name="idChien", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idchien;

    /**
     * @var string
     * @Assert\NotBlank(message=" nom doit etre non vide")
     * @ORM\Column(name="nom", type="string", length=20, nullable=false)
     */
    private $nom;

    /**
     * @var string|null
     * @Assert\NotBlank(message=" sexe doit etre non vide")
     * @ORM\Column(name="sexe", type="string", length=1, nullable=true, options={"default"="NULL"})
     */
    private $sexe;

    /**
     * @var string
     * @Assert\NotBlank(message=" age doit etre non vide")
     * @ORM\Column(name="age", type="string", length=50, nullable=false)
     */
    private $age;

    /**
     * @var bool|null
     * @Assert\NotBlank(message=" vaccination doit etre non vide")
     * @ORM\Column(name="vaccination", type="boolean", nullable=true, options={"default"="NULL"})
     */
    private $vaccination = 'NULL';

    /**
     * @var string
     * @Assert\NotBlank(message=" description doit etre non vide")
     * @ORM\Column(name="description", type="string", length=500, nullable=false)
     */
    private $description;

    /**
     * @var string|null
     * @ORM\Column(name="image", type="string", length=30, nullable=true, options={"default"="NULL"})
     */
    private $image;

    /**
     * @var string
     * @Assert\NotBlank(message=" couleur doit etre non vide")
     * @ORM\Column(name="color", type="string", length=50, nullable=false)
     */
    private $color;

    /**
     * @var string
     * @Assert\NotBlank(message=" race doit etre non vide")
     * @ORM\Column(name="race", type="string", length=100, nullable=false)
     */
    private $race;

    /**
     * @var string
     * @Assert\NotBlank(message=" groupe doit etre non vide")
     * @ORM\Column(name="groupe", type="string", length=100, nullable=false)
     */
    private $groupe;

    /**
     * @var bool
     *
     * @ORM\Column(name="playWithMe", type="boolean", nullable=false)
     */
    private $playwithme = '0';

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
     * @param int $idchien
     */
    public function __construct(int $idchien)
    {
        $this->idchien = $idchien;
    }

    public function getIdchien(): ?int
    {
        return $this->idchien;
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

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(?string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setAge(string $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getVaccination(): ?bool
    {
        return $this->vaccination;
    }

    public function setVaccination(?bool $vaccination): self
    {
        $this->vaccination = $vaccination;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getRace(): ?string
    {
        return $this->race;
    }

    public function setRace(string $race): self
    {
        $this->race = $race;

        return $this;
    }

    public function getGroupe(): ?string
    {
        return $this->groupe;
    }

    public function setGroupe(string $groupe): self
    {
        $this->groupe = $groupe;

        return $this;
    }


    public function getPlaywithme(): ?bool
    {
        return $this->playwithme;
    }

    public function setPlaywithme(bool $playwithme): self
    {
        $this->playwithme = $playwithme;

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

    public function __toString() {
        return (strval($this->idchien));
    }
}
