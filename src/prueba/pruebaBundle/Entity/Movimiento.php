<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Movimiento
 *
 * @ORM\Table(name="movimiento", indexes={@ORM\Index(name="fk_movimientohistorico_producto1_idx", columns={"idproducto"}), @ORM\Index(name="fk_movimiento_almacen1_idx", columns={"idalmacen"})})
 * @ORM\Entity
 */
class Movimiento
{
    /**
     * @var string
     *
     * @ORM\Column(name="cantidad", type="string", length=45, nullable=true)
     */
    private $cantidad;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechamovimiento", type="date", nullable=true)
     */
    private $fechamovimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="tipomovimiento", type="string", length=45, nullable=true)
     */
    private $tipomovimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="conceptomovimiento", type="string", length=45, nullable=true)
     */
    private $conceptomovimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="idmovimiento", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmovimiento;

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
     * @param string $cantidad
     *
     * @return Movimiento
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return string
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set fechamovimiento
     *
     * @param \DateTime $fechamovimiento
     *
     * @return Movimiento
     */
    public function setFechamovimiento($fechamovimiento)
    {
        $this->fechamovimiento = $fechamovimiento;

        return $this;
    }

    /**
     * Get fechamovimiento
     *
     * @return \DateTime
     */
    public function getFechamovimiento()
    {
        return $this->fechamovimiento;
    }

    /**
     * Set tipomovimiento
     *
     * @param string $tipomovimiento
     *
     * @return Movimiento
     */
    public function setTipomovimiento($tipomovimiento)
    {
        $this->tipomovimiento = $tipomovimiento;

        return $this;
    }

    /**
     * Get tipomovimiento
     *
     * @return string
     */
    public function getTipomovimiento()
    {
        return $this->tipomovimiento;
    }

    /**
     * Set conceptomovimiento
     *
     * @param string $conceptomovimiento
     *
     * @return Movimiento
     */
    public function setConceptomovimiento($conceptomovimiento)
    {
        $this->conceptomovimiento = $conceptomovimiento;

        return $this;
    }

    /**
     * Get conceptomovimiento
     *
     * @return string
     */
    public function getConceptomovimiento()
    {
        return $this->conceptomovimiento;
    }

    /**
     * Get idmovimiento
     *
     * @return integer
     */
    public function getIdmovimiento()
    {
        return $this->idmovimiento;
    }

    /**
     * Set idproducto
     *
     * @param \prueba\pruebaBundle\Entity\Producto $idproducto
     *
     * @return Movimiento
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
     * @return Movimiento
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
