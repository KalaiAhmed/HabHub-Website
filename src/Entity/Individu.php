<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Individu
 *
 * @ORM\Table(name="individu", indexes={@ORM\Index(name="fk_individu_utilisateur", columns={"idUtilisateur"})})
 * @ORM\Entity
 */
class Individu
{
    /**
     * @var int
     *
     * @ORM\Column(name="idIndividu", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idindividu;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prenom", type="string", length=100, nullable=true, options={"default"="NULL"})
     */
    private $prenom = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dateNaissance", type="date", nullable=true, options={"default"="NULL"})
     */
    private $datenaissance = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="sexe", type="string", length=1, nullable=true, options={"default"="NULL"})
     */
    private $sexe = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse", type="string", length=300, nullable=true, options={"default"="NULL"})
     */
    private $adresse = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="facebook", type="string", length=300, nullable=true, options={"default"="NULL"})
     */
    private $facebook = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="instagram", type="string", length=300, nullable=true, options={"default"="NULL"})
     */
    private $instagram = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="whatsapp", type="string", length=300, nullable=true, options={"default"="NULL"})
     */
    private $whatsapp = 'NULL';

    /**
     * @var bool
     *
     * @ORM\Column(name="proprietaireChien", type="boolean", nullable=false)
     */
    private $proprietairechien = '0';

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUtilisateur", referencedColumnName="idUtilisateur")
     * })
     */
    private $idutilisateur;


}
