<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inventario
 *
 * @ORM\Table(name="inventario", indexes={@ORM\Index(name="fk_inventario_almacen1_idx", columns={"idalmacen"}), @ORM\Index(name="fk_inventario_producto1_idx", columns={"idproducto"})})
 * @ORM\Entity
 */
class Inventario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad", type="integer", nullable=true)
     */
    private $cantidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="idinventario", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idinventario;

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
     * @var \prueba\pruebaBundle\Entity\Almacen
     *
     * @ORM\ManyToOne(targetEntity="prueba\pruebaBundle\Entity\Almacen")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idalmacen", referencedColumnName="idalmacen")
     * })
     */
    private $idalmacen;



    /**
     * Set cantidad
     *
     * @param integer $cantidad
     *
     * @return Inventario
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
     * Get idinventario
     *
     * @return integer
     */
    public function getIdinventario()
    {
        return $this->idinventario;
    }

    /**
     * Set idproducto
     *
     * @param \prueba\pruebaBundle\Entity\Producto $idproducto
     *
     * @return Inventario
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
     * Set idalmacen
     *
     * @param \prueba\pruebaBundle\Entity\Almacen $idalmacen
     *
     * @return Inventario
     */
    public function setIdalmacen(\prueba\pruebaBundle\Entity\Almacen $idalmacen = null)
    {
        $this->idalmacen = $idalmacen;

        return $this;
    }

    /**
     * Get idalmacen
     *
     * @return \prueba\pruebaBundle\Entity\Almacen
     */
    public function getIdalmacen()
    {
        return $this->idalmacen;
    }
}
