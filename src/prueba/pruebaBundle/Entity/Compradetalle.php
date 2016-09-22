<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Compradetalle
 *
 * @ORM\Table(name="compradetalle", indexes={@ORM\Index(name="fk_compradetalle_compra1_idx", columns={"idcompra"}), @ORM\Index(name="fk_compradetalle_producto1_idx", columns={"idproducto"})})
 * @ORM\Entity
 */
class Compradetalle
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad", type="integer", nullable=true)
     */
    private $cantidad;

    /**
     * @var float
     *
     * @ORM\Column(name="preciocompra", type="float", precision=10, scale=0, nullable=true)
     */
    private $preciocompra;

    /**
     * @var integer
     *
     * @ORM\Column(name="idcompradetalle", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcompradetalle;

    /**
     * @var \prueba\pruebaBundle\Entity\Producto
     *
     * @ORM\ManyToOne(targetEntity="prueba\pruebaBundle\Entity\Producto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idproducto", referencedColumnName="idproducto")
     * })
     */
    private $idproducto;

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
     * Set cantidad
     *
     * @param integer $cantidad
     *
     * @return Compradetalle
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set preciocompra
     *
     * @param float $preciocompra
     *
     * @return Compradetalle
     */
    public function setPreciocompra($preciocompra)
    {
        $this->preciocompra = $preciocompra;

        return $this;
    }

    /**
     * Get preciocompra
     *
     * @return float
     */
    public function getPreciocompra()
    {
        return $this->preciocompra;
    }

    /**
     * Get idcompradetalle
     *
     * @return integer
     */
    public function getIdcompradetalle()
    {
        return $this->idcompradetalle;
    }

    /**
     * Set idproducto
     *
     * @param \prueba\pruebaBundle\Entity\Producto $idproducto
     *
     * @return Compradetalle
     */
    public function setIdproducto(\prueba\pruebaBundle\Entity\Producto $idproducto = null)
    {
        $this->idproducto = $idproducto;

        return $this;
    }

    /**
     * Get idproducto
     *
     * @return \prueba\pruebaBundle\Entity\Producto
     */
    public function getIdproducto()
    {
        return $this->idproducto;
    }

    /**
     * Set idcompra
     *
     * @param \prueba\pruebaBundle\Entity\Compra $idcompra
     *
     * @return Compradetalle
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
