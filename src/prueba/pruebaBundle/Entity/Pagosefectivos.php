<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pagosefectivos
 *
 * @ORM\Table(name="pagosefectivos", indexes={@ORM\Index(name="fk_pagosefectivos_pagos1_idx", columns={"idpagos"})})
 * @ORM\Entity
 */
class Pagosefectivos
{
    /**
     * @var float
     *
     * @ORM\Column(name="pagosefectivomonto", type="float", precision=10, scale=0, nullable=true)
     */
    private $pagosefectivomonto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechapagoefectivo", type="date", nullable=true)
     */
    private $fechapagoefectivo;

    /**
     * @var string
     *
     * @ORM\Column(name="numerosolicitud", type="string", length=45, nullable=true)
     */
    private $numerosolicitud;

    /**
     * @var integer
     *
     * @ORM\Column(name="idpagosefectivos", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpagosefectivos;

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
     * Set pagosefectivomonto
     *
     * @param float $pagosefectivomonto
     *
     * @return Pagosefectivos
     */
    public function setPagosefectivomonto($pagosefectivomonto)
    {
        $this->pagosefectivomonto = $pagosefectivomonto;

        return $this;
    }

    /**
     * Get pagosefectivomonto
     *
     * @return float
     */
    public function getPagosefectivomonto()
    {
        return $this->pagosefectivomonto;
    }

    /**
     * Set fechapagoefectivo
     *
     * @param \DateTime $fechapagoefectivo
     *
     * @return Pagosefectivos
     */
    public function setFechapagoefectivo($fechapagoefectivo)
    {
        $this->fechapagoefectivo = $fechapagoefectivo;

        return $this;
    }

    /**
     * Get fechapagoefectivo
     *
     * @return \DateTime
     */
    public function getFechapagoefectivo()
    {
        return $this->fechapagoefectivo;
    }

    /**
     * Set numerosolicitud
     *
     * @param string $numerosolicitud
     *
     * @return Pagosefectivos
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
     * Get idpagosefectivos
     *
     * @return integer
     */
    public function getIdpagosefectivos()
    {
        return $this->idpagosefectivos;
    }

    /**
     * Set idpagos
     *
     * @param \prueba\pruebaBundle\Entity\Pagos $idpagos
     *
     * @return Pagosefectivos
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
