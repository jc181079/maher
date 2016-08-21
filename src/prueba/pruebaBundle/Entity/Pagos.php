<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pagos
 *
 * @ORM\Table(name="pagos", indexes={@ORM\Index(name="fk_pagosefectivo_solicitud1_idx", columns={"idsolicitud"})})
 * @ORM\Entity
 */
class Pagos
{
    /**
     * @var float
     *
     * @ORM\Column(name="montopagado", type="float", precision=10, scale=0, nullable=true)
     */
    private $montopagado;

    /**
     * @var string
     *
     * @ORM\Column(name="tipopago", type="string", length=45, nullable=true)
     */
    private $tipopago;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="text", nullable=true)
     */
    private $observacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechapago", type="date", nullable=true)
     */
    private $fechapago;

    /**
     * @var integer
     *
     * @ORM\Column(name="idpagos", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpagos;

    /**
     * @var \prueba\pruebaBundle\Entity\Solicitud
     *
     * @ORM\ManyToOne(targetEntity="prueba\pruebaBundle\Entity\Solicitud")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idsolicitud", referencedColumnName="idsolicitud")
     * })
     */
    private $idsolicitud;



    /**
     * Set montopagado
     *
     * @param float $montopagado
     *
     * @return Pagos
     */
    public function setMontopagado($montopagado)
    {
        $this->montopagado = $montopagado;

        return $this;
    }

    /**
     * Get montopagado
     *
     * @return float
     */
    public function getMontopagado()
    {
        return $this->montopagado;
    }

    /**
     * Set tipopago
     *
     * @param string $tipopago
     *
     * @return Pagos
     */
    public function setTipopago($tipopago)
    {
        $this->tipopago = $tipopago;

        return $this;
    }

    /**
     * Get tipopago
     *
     * @return string
     */
    public function getTipopago()
    {
        return $this->tipopago;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     *
     * @return Pagos
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * Get observacion
     *
     * @return string
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Set fechapago
     *
     * @param \DateTime $fechapago
     *
     * @return Pagos
     */
    public function setFechapago($fechapago)
    {
        $this->fechapago = $fechapago;

        return $this;
    }

    /**
     * Get fechapago
     *
     * @return \DateTime
     */
    public function getFechapago()
    {
        return $this->fechapago;
    }

    /**
     * Get idpagos
     *
     * @return integer
     */
    public function getIdpagos()
    {
        return $this->idpagos;
    }

    /**
     * Set idsolicitud
     *
     * @param \prueba\pruebaBundle\Entity\Solicitud $idsolicitud
     *
     * @return Pagos
     */
    public function setIdsolicitud(\prueba\pruebaBundle\Entity\Solicitud $idsolicitud = null)
    {
        $this->idsolicitud = $idsolicitud;

        return $this;
    }

    /**
     * Get idsolicitud
     *
     * @return \prueba\pruebaBundle\Entity\Solicitud
     */
    public function getIdsolicitud()
    {
        return $this->idsolicitud;
    }
}
