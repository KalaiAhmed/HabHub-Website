<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Magasin
 *
 * @ORM\Table(name="magasin", indexes={@ORM\Index(name="fk_magasin_utilisateur", columns={"idUtilisateur"})})
 * @ORM\Entity
 */
class Magasin
{
    /**
     * @var int
     *
     * @ORM\Column(name="idMagasin", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmagasin;

    /**
     * @var string
     *
     * @ORM\Column(name="nomMagasin", type="string", length=30, nullable=false)
     */
    private $nommagasin;

    /**
     * @var string
     *
     * @ORM\Column(name="nomGestionnaireMagasin", type="string", length=50, nullable=false)
     */
    private $nomgestionnairemagasin;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=100, nullable=false)
     */
    private $adresse;

    /**
     * @var int
     *
     * @ORM\Column(name="codePostal", type="integer", nullable=false)
     */
    private $codepostal;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=20, nullable=false)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="nomRepLegal", type="string", length=50, nullable=false)
     */
    private $nomreplegal;

    /**
     * @var int
     *
     * @ORM\Column(name="cinRepLegal", type="integer", nullable=false)
     */
    private $cinreplegal;

    /**
     * @var string
     *
     * @ORM\Column(name="matriculeFiscale", type="string", length=15, nullable=false)
     */
    private $matriculefiscale;

    /**
     * @var string
     *
     * @ORM\Column(name="identifiantFiscal", type="string", length=20, nullable=false)
     */
    private $identifiantfiscal;

    /**
     * @var binary|null
     *
     * @ORM\Column(name="patente", type="binary", nullable=true, options={"default"="NULL"})
     */
    private $patente = 'NULL';

    /**
     * @var int
     *
     * @ORM\Column(name="RIB", type="integer", nullable=false)
     */
    private $rib;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUtilisateur", referencedColumnName="idUtilisateur")
     * })
     */
    private $idutilisateur;

    /**
     * @return int
     */
    public function getIdmagasin(): int
    {
        return $this->idmagasin;
    }

    /**
     * @param int $idmagasin
     */
    public function setIdmagasin(int $idmagasin): void
    {
        $this->idmagasin = $idmagasin;
    }

    /**
     * @return string
     */
    public function getNommagasin(): string
    {
        return $this->nommagasin;
    }

    /**
     * @param string $nommagasin
     */
    public function setNommagasin(string $nommagasin): void
    {
        $this->nommagasin = $nommagasin;
    }

    /**
     * @return string
     */
    public function getNomgestionnairemagasin(): string
    {
        return $this->nomgestionnairemagasin;
    }

    /**
     * @param string $nomgestionnairemagasin
     */
    public function setNomgestionnairemagasin(string $nomgestionnairemagasin): void
    {
        $this->nomgestionnairemagasin = $nomgestionnairemagasin;
    }

    /**
     * @return string
     */
    public function getAdresse(): string
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse(string $adresse): void
    {
        $this->adresse = $adresse;
    }

    /**
     * @return int
     */
    public function getCodepostal(): int
    {
        return $this->codepostal;
    }

    /**
     * @param int $codepostal
     */
    public function setCodepostal(int $codepostal): void
    {
        $this->codepostal = $codepostal;
    }

    /**
     * @return string
     */
    public function getVille(): string
    {
        return $this->ville;
    }

    /**
     * @param string $ville
     */
    public function setVille(string $ville): void
    {
        $this->ville = $ville;
    }

    /**
     * @return string
     */
    public function getNomreplegal(): string
    {
        return $this->nomreplegal;
    }

    /**
     * @param string $nomreplegal
     */
    public function setNomreplegal(string $nomreplegal): void
    {
        $this->nomreplegal = $nomreplegal;
    }

    /**
     * @return int
     */
    public function getCinreplegal(): int
    {
        return $this->cinreplegal;
    }

    /**
     * @param int $cinreplegal
     */
    public function setCinreplegal(int $cinreplegal): void
    {
        $this->cinreplegal = $cinreplegal;
    }

    /**
     * @return string
     */
    public function getMatriculefiscale(): string
    {
        return $this->matriculefiscale;
    }

    /**
     * @param string $matriculefiscale
     */
    public function setMatriculefiscale(string $matriculefiscale): void
    {
        $this->matriculefiscale = $matriculefiscale;
    }

    /**
     * @return string
     */
    public function getIdentifiantfiscal(): string
    {
        return $this->identifiantfiscal;
    }

    /**
     * @param string $identifiantfiscal
     */
    public function setIdentifiantfiscal(string $identifiantfiscal): void
    {
        $this->identifiantfiscal = $identifiantfiscal;
    }

    /**
     * @return binary|null
     */
    public function getPatente()
    {
        return $this->patente;
    }

    /**
     * @param binary|null $patente
     */
    public function setPatente($patente): void
    {
        $this->patente = $patente;
    }

    /**
     * @return int
     */
    public function getRib(): int
    {
        return $this->rib;
    }

    /**
     * @param int $rib
     */
    public function setRib(int $rib): void
    {
        $this->rib = $rib;
    }

    /**
     * @return \Utilisateur
     */
    public function getIdutilisateur(): \Utilisateur
    {
        return $this->idutilisateur;
    }

    /**
     * @param \Utilisateur $idutilisateur
     */
    public function setIdutilisateur(\Utilisateur $idutilisateur): void
    {
        $this->idutilisateur = $idutilisateur;
    }


}
