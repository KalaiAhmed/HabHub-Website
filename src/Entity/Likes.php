<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Likes
 *
 * @ORM\Table(name="likes", indexes={@ORM\Index(name="idIndividu", columns={"idIndividu"}), @ORM\Index(name="idChien", columns={"idChien"})})
 * @ORM\Entity(repositoryClass="App\Repository\LikesRepository")
 */
class Likes
{
    /**
     * @var int
     *
     * @ORM\Column(name="idLike", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idlike;

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
     * @var \Chien
     *
     * @ORM\ManyToOne(targetEntity="Chien")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idChien", referencedColumnName="idChien")
     * })
     */
    private $idchien;

    public function getIdlike(): ?int
    {
        return $this->idlike;
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

    public function getIdchien(): ?Chien
    {
        return $this->idchien;
    }

    public function setIdchien(?Chien $idchien): self
    {
        $this->idchien = $idchien;

        return $this;
    }


}
