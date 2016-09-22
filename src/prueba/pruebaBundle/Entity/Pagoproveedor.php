<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pagoproveedor
 *
 * @ORM\Table(name="pagoproveedor", indexes={@ORM\Index(name="fk_pagoproveedor_proveedor1_idx", columns={"idproveedor"}), @ORM\Index(name="fk_pagoproveedor_compra1_idx", columns={"idcompra"})})
 * @ORM\Entity
 */
class Pagoproveedor
{
    /**
     * @var string
     *
     * @ORM\Column(name="tipopago", type="string", length=45, nullable=true)
     */
    private $tipopago;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechapago", type="date", nullable=true)
     */
    private $fechapago;

    /**
     * @var string
     *
     * @ORM\Column(name="montopago", type="string", length=45, nullable=true)
     */
    private $montopago;

    /**
     * @var integer
     *
     * @ORM\Column(name="idpagoproveedor", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpagoproveedor;

    /**
     * @var \prueba\pruebaBundle\Entity\Proveedor
     *
     * @ORM\ManyToOne(targetEntity="prueba\pruebaBundle\Entity\Proveedor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idproveedor", referencedColumnName="idproveedor")
     * })
     */
    private $idproveedor;

    /**
     * @var \prueba\pruebaBundle\Entity\Compra
     *
     * @ORM\ManyToOne(targetEntity="prueba\pruebaBundle\Entity\Compra")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idcompra", referencedColumnName="idcompra")
     * })
     */
    private $idcompra;



    /**
     * Set tipopago
     *
     * @param string $tipopago
     *
     * @return Pagoproveedor
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
     * Set fechapago
     *
     * @param \DateTime $fechapago
     *
     * @return Pagoproveedor
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
     * Set montopago
     *
     * @param string $montopago
     *
     * @return Pagoproveedor
     */
    public function setMontopago($montopago)
    {
        $this->montopago = $montopago;

        return $this;
    }

    /**
     * Get montopago
     *
     * @return string
     */
    public function getMontopago()
    {
        return $this->montopago;
    }

    /**
     * Get idpagoproveedor
     *
     * @return integer
     */
    public function getIdpagoproveedor()
    {
        return $this->idpagoproveedor;
    }

    /**
     * Set idproveedor
     *
     * @param \prueba\pruebaBundle\Entity\Proveedor $idproveedor
     *
     * @return Pagoproveedor
     */
    public function setIdproveedor(\prueba\pruebaBundle\Entity\Proveedor $idproveedor = null)
    {
        $this->idproveedor = $idproveedor;

        return $this;
    }

    /**
     * Get idproveedor
     *
     * @return \prueba\pruebaBundle\Entity\Proveedor
     */
    public function getIdproveedor()
    {
        return $this->idproveedor;
    }

    /**
     * Set idcompra
     *
     * @param \prueba\pruebaBundle\Entity\Compra $idcompra
     *
     * @return Pagoproveedor
     */
    public function setIdcompra(\prueba\pruebaBundle\Entity\Compra $idcompra = null)
    {
        $this->idcompra = $idcompra;

        return $this;
    }

    /**
     * Get idcompra
     *
     * @return \prueba\pruebaBundle\Entity\Compra
     */
    public function getIdcompra()
    {
        return $this->idcompra;
    }
}
