<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande", indexes={@ORM\Index(name="fk_commande_utilisateur", columns={"idUtilisateur"})})
 * @ORM\Entity
 */
class Commande
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCommande", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcommande;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCommande", type="date", nullable=false)
     */
    private $datecommande;

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
    public function getIdcommande(): int
    {
        return $this->idcommande;
    }

    /**
     * @param int $idcommande
     */
    public function setIdcommande(int $idcommande): void
    {
        $this->idcommande = $idcommande;
    }

    /**
     * @return \DateTime
     */
    public function getDatecommande(): \DateTime
    {
        return $this->datecommande;
    }

    /**
     * @param \DateTime $datecommande
     */
    public function setDatecommande(\DateTime $datecommande): void
    {
        $this->datecommande = $datecommande;
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
