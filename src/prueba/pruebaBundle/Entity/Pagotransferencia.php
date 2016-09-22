<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pagotransferencia
 *
 * @ORM\Table(name="pagotransferencia", indexes={@ORM\Index(name="fk_pagotransferencia_pagos1_idx", columns={"idpagos"})})
 * @ORM\Entity
 */
class Pagotransferencia
{
    /**
     * @var string
     *
     * @ORM\Column(name="estatustransferencia", type="string", length=45, nullable=true)
     */
    private $estatustransferencia;

    /**
     * @var string
     *
     * @ORM\Column(name="bancobeneficiado", type="string", length=45, nullable=true)
     */
    private $bancobeneficiado;

    /**
     * @var string
     *
     * @ORM\Column(name="cuentabeneficiada", type="string", length=45, nullable=true)
     */
    private $cuentabeneficiada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechatransferencia", type="date", nullable=true)
     */
    private $fechatransferencia;

    /**
     * @var string
     *
     * @ORM\Column(name="numerosolicitud", type="string", length=45, nullable=true)
     */
    private $numerosolicitud;

    /**
     * @var integer
     *
     * @ORM\Column(name="idpagotransferencia", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpagotransferencia;

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
     * Set estatustransferencia
     *
     * @param string $estatustransferencia
     *
     * @return Pagotransferencia
     */
    public function setEstatustransferencia($estatustransferencia)
    {
        $this->estatustransferencia = $estatustransferencia;

        return $this;
    }

    /**
     * Get estatustransferencia
     *
     * @return string
     */
    public function getEstatustransferencia()
    {
        return $this->estatustransferencia;
    }

    /**
     * Set bancobeneficiado
     *
     * @param string $bancobeneficiado
     *
     * @return Pagotransferencia
     */
    public function setBancobeneficiado($bancobeneficiado)
    {
        $this->bancobeneficiado = $bancobeneficiado;

        return $this;
    }

    /**
     * Get bancobeneficiado
     *
     * @return string
     */
    public function getBancobeneficiado()
    {
        return $this->bancobeneficiado;
    }

    /**
     * Set cuentabeneficiada
     *
     * @param string $cuentabeneficiada
     *
     * @return Pagotransferencia
     */
    public function setCuentabeneficiada($cuentabeneficiada)
    {
        $this->cuentabeneficiada = $cuentabeneficiada;

        return $this;
    }

    /**
     * Get cuentabeneficiada
     *
     * @return string
     */
    public function getCuentabeneficiada()
    {
        return $this->cuentabeneficiada;
    }

    /**
     * Set fechatransferencia
     *
     * @param \DateTime $fechatransferencia
     *
     * @return Pagotransferencia
     */
    public function setFechatransferencia($fechatransferencia)
    {
        $this->fechatransferencia = $fechatransferencia;

        return $this;
    }

    /**
     * Get fechatransferencia
     *
     * @return \DateTime
     */
    public function getFechatransferencia()
    {
        return $this->fechatransferencia;
    }

    /**
     * Set numerosolicitud
     *
     * @param string $numerosolicitud
     *
     * @return Pagotransferencia
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
     * Get idpagotransferencia
     *
     * @return integer
     */
    public function getIdpagotransferencia()
    {
        return $this->idpagotransferencia;
    }

    /**
     * Set idpagos
     *
     * @param \prueba\pruebaBundle\Entity\Pagos $idpagos
     *
     * @return Pagotransferencia
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
