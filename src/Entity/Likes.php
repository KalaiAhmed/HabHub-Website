<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Likes
 *
 * @ORM\Table(name="likes", indexes={@ORM\Index(name="idIndividu", columns={"idIndividu"}), @ORM\Index(name="idChien", columns={"idChien"})})
 * @ORM\Entity
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

    /**
     * @return int
     */
    public function getIdlike(): int
    {
        return $this->idlike;
    }

    /**
     * @param int $idlike
     */
    public function setIdlike(int $idlike): void
    {
        $this->idlike = $idlike;
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
