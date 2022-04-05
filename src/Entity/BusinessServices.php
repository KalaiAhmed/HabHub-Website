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

    /**
     * @return int
     */
    public function getIdbusinessservices(): int
    {
        return $this->idbusinessservices;
    }

    /**
     * @param int $idbusinessservices
     */
    public function setIdbusinessservices(int $idbusinessservices): void
    {
        $this->idbusinessservices = $idbusinessservices;
    }

    /**
     * @return string
     */
    public function getNomservice(): string
    {
        return $this->nomservice;
    }

    /**
     * @param string $nomservice
     */
    public function setNomservice(string $nomservice): void
    {
        $this->nomservice = $nomservice;
    }

    /**
     * @return float
     */
    public function getPrix(): float
    {
        return $this->prix;
    }

    /**
     * @param float $prix
     */
    public function setPrix(float $prix): void
    {
        $this->prix = $prix;
    }

    /**
     * @return \Business
     */
    public function getIdbusiness(): \Business
    {
        return $this->idbusiness;
    }

    /**
     * @param \Business $idbusiness
     */
    public function setIdbusiness(\Business $idbusiness): void
    {
        $this->idbusiness = $idbusiness;
    }


}
