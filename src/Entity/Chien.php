<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chien
 *
 * @ORM\Table(name="chien", indexes={@ORM\Index(name="idIndividu", columns={"idIndividu"})})
 * @ORM\Entity
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
     *
     * @ORM\Column(name="nom", type="string", length=20, nullable=false)
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sexe", type="string", length=1, nullable=true, options={"default"="NULL"})
     */
    private $sexe = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="age", type="string", length=50, nullable=false)
     */
    private $age;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="vaccination", type="boolean", nullable=true, options={"default"="NULL"})
     */
    private $vaccination = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=500, nullable=false)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=30, nullable=true, options={"default"="NULL"})
     */
    private $image = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=50, nullable=false)
     */
    private $color;

    /**
     * @var string
     *
     * @ORM\Column(name="race", type="string", length=100, nullable=false)
     */
    private $race;

    /**
     * @var string
     *
     * @ORM\Column(name="groupe", type="string", length=100, nullable=false)
     */
    private $groupe;

    /**
     * @var int
     *
     * @ORM\Column(name="likeNumber", type="integer", nullable=false)
     */
    private $likenumber = '0';

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

    public function getLikenumber(): ?int
    {
        return $this->likenumber;
    }

    public function setLikenumber(int $likenumber): self
    {
        $this->likenumber = $likenumber;

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


}
