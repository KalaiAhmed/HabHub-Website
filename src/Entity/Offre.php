<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Offre
 * @ORM\Table(name="offre", indexes={@ORM\Index(name="foster", columns={"foster"}), @ORM\Index(name="announce", columns={"announce"}), @ORM\Index(name="adopter", columns={"adopter"})})
 * @ORM\Entity(repositoryClass="App\Repository\OffreRepository")
 */
class Offre
{
    /**
     * @var int
     *
     * @ORM\Column(name="idOffre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idoffre;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=20, nullable=false)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="date", nullable=false)
     */
    private $createdAt;

    /**
     * @var string
     *@Assert\NotBlank(message=" champ obligatoire")
     *@Assert\Length(
     *      min = 3,
     *      minMessage=" au moin 3 caractéres"
     *
     *     )
     *
     * @ORM\Column(name="sujet", type="text", length=65535, nullable=false)
     */
    private $sujet;

    /**
     * @var \AnnonceAdoption
     *
     * @ORM\ManyToOne(targetEntity="AnnonceAdoption")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="announce", referencedColumnName="idAnnonceAdoption")
     * })
     */
    private $announce;

    /**
     * @var \Individu
     *
     * @ORM\ManyToOne(targetEntity="Individu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="adopter", referencedColumnName="idIndividu")
     * })
     */
    private $adopter;

    /**
     * @var \Individu
     *
     * @ORM\ManyToOne(targetEntity="Individu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="foster", referencedColumnName="idIndividu")
     * })
     */
    private $foster;


    public function getIdoffre(): ?int
    {
        return $this->idoffre;
    }




    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedat(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedat(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }


    public function getFoster(): ?Individu
    {
        return $this->foster;
    }

    public function setFoster(?Individu $idindividu): self
    {
        $this->foster = $idindividu;

        return $this;
    }

    public function getAdopter(): ?Individu
    {
        return $this->adopter;
    }

    public function setAdopter(?Individu $idindividu): self
    {
        $this->adopter = $idindividu;

        return $this;
    }


    public function getAnnounce(): ?AnnonceAdoption
    {
        return $this->announce;
    }

    public function setAnnounce(?AnnonceAdoption $idannonceadoption): self
    {
        $this->announce = $idannonceadoption;

        return $this;
    }


    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(?string $sujet): self
    {
        $this->sujet = $sujet;

        return $this;
    }



}
