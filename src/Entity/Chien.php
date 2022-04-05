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

    /**
     * @return int
     */
    public function getIdchien(): int
    {
        return $this->idchien;
    }

    /**
     * @param int $idchien
     */
    public function setIdchien(int $idchien): void
    {
        $this->idchien = $idchien;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return string|null
     */
    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    /**
     * @param string|null $sexe
     */
    public function setSexe(?string $sexe): void
    {
        $this->sexe = $sexe;
    }

    /**
     * @return string
     */
    public function getAge(): string
    {
        return $this->age;
    }

    /**
     * @param string $age
     */
    public function setAge(string $age): void
    {
        $this->age = $age;
    }

    /**
     * @return bool|null
     */
    public function getVaccination()
    {
        return $this->vaccination;
    }

    /**
     * @param bool|null $vaccination
     */
    public function setVaccination($vaccination): void
    {
        $this->vaccination = $vaccination;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     */
    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    /**
     * @return string
     */
    public function getRace(): string
    {
        return $this->race;
    }

    /**
     * @param string $race
     */
    public function setRace(string $race): void
    {
        $this->race = $race;
    }

    /**
     * @return string
     */
    public function getGroupe(): string
    {
        return $this->groupe;
    }

    /**
     * @param string $groupe
     */
    public function setGroupe(string $groupe): void
    {
        $this->groupe = $groupe;
    }

    /**
     * @return int
     */
    public function getLikenumber()
    {
        return $this->likenumber;
    }

    /**
     * @param int $likenumber
     */
    public function setLikenumber($likenumber): void
    {
        $this->likenumber = $likenumber;
    }

    /**
     * @return bool
     */
    public function isPlaywithme()
    {
        return $this->playwithme;
    }

    /**
     * @param bool $playwithme
     */
    public function setPlaywithme($playwithme): void
    {
        $this->playwithme = $playwithme;
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


}
