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

    public function getIdmagasin(): ?int
    {
        return $this->idmagasin;
    }

    public function getNommagasin(): ?string
    {
        return $this->nommagasin;
    }

    public function setNommagasin(string $nommagasin): self
    {
        $this->nommagasin = $nommagasin;

        return $this;
    }

    public function getNomgestionnairemagasin(): ?string
    {
        return $this->nomgestionnairemagasin;
    }

    public function setNomgestionnairemagasin(string $nomgestionnairemagasin): self
    {
        $this->nomgestionnairemagasin = $nomgestionnairemagasin;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodepostal(): ?int
    {
        return $this->codepostal;
    }

    public function setCodepostal(int $codepostal): self
    {
        $this->codepostal = $codepostal;

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

    public function getNomreplegal(): ?string
    {
        return $this->nomreplegal;
    }

    public function setNomreplegal(string $nomreplegal): self
    {
        $this->nomreplegal = $nomreplegal;

        return $this;
    }

    public function getCinreplegal(): ?int
    {
        return $this->cinreplegal;
    }

    public function setCinreplegal(int $cinreplegal): self
    {
        $this->cinreplegal = $cinreplegal;

        return $this;
    }

    public function getMatriculefiscale(): ?string
    {
        return $this->matriculefiscale;
    }

    public function setMatriculefiscale(string $matriculefiscale): self
    {
        $this->matriculefiscale = $matriculefiscale;

        return $this;
    }

    public function getIdentifiantfiscal(): ?string
    {
        return $this->identifiantfiscal;
    }

    public function setIdentifiantfiscal(string $identifiantfiscal): self
    {
        $this->identifiantfiscal = $identifiantfiscal;

        return $this;
    }

    public function getPatente()
    {
        return $this->patente;
    }

    public function setPatente($patente): self
    {
        $this->patente = $patente;

        return $this;
    }

    public function getRib(): ?int
    {
        return $this->rib;
    }

    public function setRib(int $rib): self
    {
        $this->rib = $rib;

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
