<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Solicituddetalle
 *
 * @ORM\Table(name="solicituddetalle", indexes={@ORM\Index(name="fk_solicituddetalle_solicitud1_idx", columns={"idsolicitud"}), @ORM\Index(name="fk_solicituddetalle_producto1_idx", columns={"idproducto"})})
 * @ORM\Entity
 */
class Solicituddetalle
{
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
