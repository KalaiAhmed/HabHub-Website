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


}
