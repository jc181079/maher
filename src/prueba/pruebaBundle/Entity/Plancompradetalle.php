<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plancompradetalle
 *
 * @ORM\Table(name="plancompradetalle", indexes={@ORM\Index(name="fk_plancompradetalle_plancompra1_idx", columns={"idplancompra"}), @ORM\Index(name="fk_plancompradetalle_producto1_idx", columns={"idproducto"})})
 * @ORM\Entity
 */
class Plancompradetalle
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
     * @ORM\Column(name="idplancompradetalle", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idplancompradetalle;

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
     * @var \prueba\pruebaBundle\Entity\Plancompra
     *
     * @ORM\ManyToOne(targetEntity="prueba\pruebaBundle\Entity\Plancompra")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idplancompra", referencedColumnName="idplancompra")
     * })
     */
    private $idplancompra;



    /**
     * Set cantidad
     *
     * @param integer $cantidad
     *
     * @return Plancompradetalle
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
     * Get idplancompradetalle
     *
     * @return integer
     */
    public function getIdplancompradetalle()
    {
        return $this->idplancompradetalle;
    }

    /**
     * Set idproducto
     *
     * @param \prueba\pruebaBundle\Entity\Producto $idproducto
     *
     * @return Plancompradetalle
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
     * Set idplancompra
     *
     * @param \prueba\pruebaBundle\Entity\Plancompra $idplancompra
     *
     * @return Plancompradetalle
     */
    public function setIdplancompra(\prueba\pruebaBundle\Entity\Plancompra $idplancompra = null)
    {
        $this->idplancompra = $idplancompra;

        return $this;
    }

    /**
     * Get idplancompra
     *
     * @return \prueba\pruebaBundle\Entity\Plancompra
     */
    public function getIdplancompra()
    {
        return $this->idplancompra;
    }
}
