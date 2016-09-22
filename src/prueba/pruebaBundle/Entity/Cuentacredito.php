<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cuentacredito
 *
 * @ORM\Table(name="cuentacredito", indexes={@ORM\Index(name="fk_cuentacredito_pagos1_idx", columns={"idpagos"})})
 * @ORM\Entity
 */
class Cuentacredito
{
    /**
     * @var string
     *
     * @ORM\Column(name="estatuscredito", type="string", length=45, nullable=true)
     */
    private $estatuscredito;

    /**
     * @var float
     *
     * @ORM\Column(name="cuentacreditomonto", type="float", precision=10, scale=0, nullable=true)
     */
    private $cuentacreditomonto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cuentacreditofecha", type="date", nullable=true)
     */
    private $cuentacreditofecha;

    /**
     * @var string
     *
     * @ORM\Column(name="numerosolicitud", type="string", length=45, nullable=true)
     */
    private $numerosolicitud;

    /**
     * @var integer
     *
     * @ORM\Column(name="idcuentacredito", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcuentacredito;

    /**
     * @var \prueba\pruebaBundle\Entity\Pagos
     *
     * @ORM\ManyToOne(targetEntity="prueba\pruebaBundle\Entity\Pagos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idpagos", referencedColumnName="idpagos")
     * })
     */
    private $idpagos;



    /**
     * Set estatuscredito
     *
     * @param string $estatuscredito
     *
     * @return Cuentacredito
     */
    public function setEstatuscredito($estatuscredito)
    {
        $this->estatuscredito = $estatuscredito;

        return $this;
    }

    /**
     * Get estatuscredito
     *
     * @return string
     */
    public function getEstatuscredito()
    {
        return $this->estatuscredito;
    }

    /**
     * Set cuentacreditomonto
     *
     * @param float $cuentacreditomonto
     *
     * @return Cuentacredito
     */
    public function setCuentacreditomonto($cuentacreditomonto)
    {
        $this->cuentacreditomonto = $cuentacreditomonto;

        return $this;
    }

    /**
     * Get cuentacreditomonto
     *
     * @return float
     */
    public function getCuentacreditomonto()
    {
        return $this->cuentacreditomonto;
    }

    /**
     * Set cuentacreditofecha
     *
     * @param \DateTime $cuentacreditofecha
     *
     * @return Cuentacredito
     */
    public function setCuentacreditofecha($cuentacreditofecha)
    {
        $this->cuentacreditofecha = $cuentacreditofecha;

        return $this;
    }

    /**
     * Get cuentacreditofecha
     *
     * @return \DateTime
     */
    public function getCuentacreditofecha()
    {
        return $this->cuentacreditofecha;
    }

    /**
     * Set numerosolicitud
     *
     * @param string $numerosolicitud
     *
     * @return Cuentacredito
     */
    public function setNumerosolicitud($numerosolicitud)
    {
        $this->numerosolicitud = $numerosolicitud;

        return $this;
    }

    /**
     * Get numerosolicitud
     *
     * @return string
     */
    public function getNumerosolicitud()
    {
        return $this->numerosolicitud;
    }

    /**
     * Get idcuentacredito
     *
     * @return integer
     */
    public function getIdcuentacredito()
    {
        return $this->idcuentacredito;
    }

    /**
     * Set idpagos
     *
     * @param \prueba\pruebaBundle\Entity\Pagos $idpagos
     *
     * @return Cuentacredito
     */
    public function setIdpagos(\prueba\pruebaBundle\Entity\Pagos $idpagos = null)
    {
        $this->idpagos = $idpagos;

        return $this;
    }

    /**
     * Get idpagos
     *
     * @return \prueba\pruebaBundle\Entity\Pagos
     */
    public function getIdpagos()
    {
        return $this->idpagos;
    }
}
