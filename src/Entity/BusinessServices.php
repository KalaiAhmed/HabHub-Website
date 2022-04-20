<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusinessServices
 *
 * @ORM\Table(name="business_services", indexes={@ORM\Index(name="idBusiness", columns={"idBusiness"})})
 * @ORM\Entity
 */
class BusinessServices
{
    /**
     * @var int
     *
     * @ORM\Column(name="idBusinessServices", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idbusinessservices;

    /**
     * @var string
     *
     * @ORM\Column(name="nomService", type="string", length=50, nullable=false)
     */
    private $nomservice;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=5, scale=3, nullable=false)
     */
    private $prix;

    /**
     * @var \Business
     *
     * @ORM\ManyToOne(targetEntity="Business")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idBusiness", referencedColumnName="idBusiness")
     * })
     */
    private $idbusiness;

    public function getIdbusinessservices(): ?int
    {
        return $this->idbusinessservices;
    }

    public function getNomservice(): ?string
    {
        return $this->nomservice;
    }

    public function setNomservice(string $nomservice): self
    {
        $this->nomservice = $nomservice;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getIdbusiness(): ?Business
    {
        return $this->idbusiness;
    }

    public function setIdbusiness(?Business $idbusiness): self
    {
        $this->idbusiness = $idbusiness;

        return $this;
    }
public function __toString()
{
    return (strval($this->idbusinessservices));

}

}
