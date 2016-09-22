<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Compra
 *
 * @ORM\Table(name="compra", indexes={@ORM\Index(name="fk_compra_proveedor1_idx", columns={"idproveedor"})})
 * @ORM\Entity
 */
class Compra
{
    /**
     * @var string
     *
     * @ORM\Column(name="comprafactura", type="string", length=45, nullable=true)
     */
    private $comprafactura;

    /**
     * @var integer
     *
     * @ORM\Column(name="compracantidad", type="integer", nullable=true)
     */
    private $compracantidad;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="comprafecha", type="date", nullable=true)
     */
    private $comprafecha;

    /**
     * @var string
     *
     * @ORM\Column(name="compraestatus", type="string", length=45, nullable=true)
     */
    private $compraestatus;

    /**
     * @var string
     *
     * @ORM\Column(name="tipocompra", type="string", length=45, nullable=true)
     */
    private $tipocompra;

    /**
     * @var integer
     *
     * @ORM\Column(name="idcompra", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcompra;

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
     * Set comprafactura
     *
     * @param string $comprafactura
     *
     * @return Compra
     */
    public function setComprafactura($comprafactura)
    {
        $this->comprafactura = $comprafactura;

        return $this;
    }

    /**
     * Get comprafactura
     *
     * @return string
     */
    public function getComprafactura()
    {
        return $this->comprafactura;
    }

    /**
     * Set compracantidad
     *
     * @param integer $compracantidad
     *
     * @return Compra
     */
    public function setCompracantidad($compracantidad)
    {
        $this->compracantidad = $compracantidad;

        return $this;
    }

    /**
     * Get compracantidad
     *
     * @return integer
     */
    public function getCompracantidad()
    {
        return $this->compracantidad;
    }

    /**
     * Set comprafecha
     *
     * @param \DateTime $comprafecha
     *
     * @return Compra
     */
    public function setComprafecha($comprafecha)
    {
        $this->comprafecha = $comprafecha;

        return $this;
    }

    /**
     * Get comprafecha
     *
     * @return \DateTime
     */
    public function getComprafecha()
    {
        return $this->comprafecha;
    }

    /**
     * Set compraestatus
     *
     * @param string $compraestatus
     *
     * @return Compra
     */
    public function setCompraestatus($compraestatus)
    {
        $this->compraestatus = $compraestatus;

        return $this;
    }

    /**
     * Get compraestatus
     *
     * @return string
     */
    public function getCompraestatus()
    {
        return $this->compraestatus;
    }

    /**
     * Set tipocompra
     *
     * @param string $tipocompra
     *
     * @return Compra
     */
    public function setTipocompra($tipocompra)
    {
        $this->tipocompra = $tipocompra;

        return $this;
    }

    /**
     * Get tipocompra
     *
     * @return string
     */
    public function getTipocompra()
    {
        return $this->tipocompra;
    }

    /**
     * Get idcompra
     *
     * @return integer
     */
    public function getIdcompra()
    {
        return $this->idcompra;
    }

    /**
     * Set idproveedor
     *
     * @param \prueba\pruebaBundle\Entity\Proveedor $idproveedor
     *
     * @return Compra
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
}
