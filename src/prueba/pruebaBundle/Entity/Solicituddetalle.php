<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Solicituddetalle
 *
 * @ORM\Table(name="solicituddetalle", indexes={@ORM\Index(name="fk_solicituddetalle_producto1_idx", columns={"idproducto"}), @ORM\Index(name="fk_solicituddetalle_solicitud1_idx", columns={"idsolicitud"})})
 * @ORM\Entity
 */
class Solicituddetalle
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
     * @ORM\Column(name="precio", type="float", precision=10, scale=0, nullable=true)
     */
    private $precio;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float", precision=10, scale=0, nullable=true)
     */
    private $total;

    /**
     * @var string
     *
     * @ORM\Column(name="numerosolicitud", type="string", length=45, nullable=true)
     */
    private $numerosolicitud;

    /**
     * @var integer
     *
     * @ORM\Column(name="idsolicituddetalle", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsolicituddetalle;

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
     * @var \prueba\pruebaBundle\Entity\Producto
     *
     * @ORM\ManyToOne(targetEntity="prueba\pruebaBundle\Entity\Producto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idproducto", referencedColumnName="idproducto")
     * })
     */
    private $idproducto;



    /**
     * Set cantidad
     *
     * @param integer $cantidad
     *
     * @return Solicituddetalle
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
     * Set precio
     *
     * @param float $precio
     *
     * @return Solicituddetalle
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return float
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set total
     *
     * @param float $total
     *
     * @return Solicituddetalle
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set numerosolicitud
     *
     * @param string $numerosolicitud
     *
     * @return Solicituddetalle
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
     * Get idsolicituddetalle
     *
     * @return integer
     */
    public function getIdsolicituddetalle()
    {
        return $this->idsolicituddetalle;
    }

    /**
     * Set idsolicitud
     *
     * @param \prueba\pruebaBundle\Entity\Solicitud $idsolicitud
     *
     * @return Solicituddetalle
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

    /**
     * Set idproducto
     *
     * @param \prueba\pruebaBundle\Entity\Producto $idproducto
     *
     * @return Solicituddetalle
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
}
