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

    /**
     * @return int
     */
    public function getIdindividu(): int
    {
        return $this->idindividu;
    }

    /**
     * @param int $idindividu
     */
    public function setIdindividu(int $idindividu): void
    {
        $this->idindividu = $idindividu;
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
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    /**
     * @param string|null $prenom
     */
    public function setPrenom(?string $prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @return \DateTime|null
     */
    public function getDatenaissance()
    {
        return $this->datenaissance;
    }

    /**
     * @param \DateTime|null $datenaissance
     */
    public function setDatenaissance($datenaissance): void
    {
        $this->datenaissance = $datenaissance;
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
     * @return string|null
     */
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    /**
     * @param string|null $adresse
     */
    public function setAdresse(?string $adresse): void
    {
        $this->adresse = $adresse;
    }

    /**
     * @return string|null
     */
    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    /**
     * @param string|null $facebook
     */
    public function setFacebook(?string $facebook): void
    {
        $this->facebook = $facebook;
    }

    /**
     * @return string|null
     */
    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    /**
     * @param string|null $instagram
     */
    public function setInstagram(?string $instagram): void
    {
        $this->instagram = $instagram;
    }

    /**
     * @return string|null
     */
    public function getWhatsapp(): ?string
    {
        return $this->whatsapp;
    }

    /**
     * @param string|null $whatsapp
     */
    public function setWhatsapp(?string $whatsapp): void
    {
        $this->whatsapp = $whatsapp;
    }

    /**
     * @return bool
     */
    public function isProprietairechien()
    {
        return $this->proprietairechien;
    }

    /**
     * @param bool $proprietairechien
     */
    public function setProprietairechien($proprietairechien): void
    {
        $this->proprietairechien = $proprietairechien;
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
