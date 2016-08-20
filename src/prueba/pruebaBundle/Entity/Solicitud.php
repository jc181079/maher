<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Solicitud
 *
 * @ORM\Table(name="solicitud", indexes={@ORM\Index(name="fk_solicitud_clientes1_idx", columns={"idclientes"}), @ORM\Index(name="fk_solicitud_seguridad1_idx", columns={"idseguridad"})})
 * @ORM\Entity
 */
class Solicitud
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechadolicitud", type="date", nullable=true)
     */
    private $fechadolicitud;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaentrega", type="date", nullable=true)
     */
    private $fechaentrega;

    /**
     * @var integer
     *
     * @ORM\Column(name="idsolicitud", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsolicitud;

    /**
     * @var \prueba\pruebaBundle\Entity\Seguridad
     *
     * @ORM\ManyToOne(targetEntity="prueba\pruebaBundle\Entity\Seguridad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idseguridad", referencedColumnName="idseguridad")
     * })
     */
    private $idseguridad;

    /**
     * @var \prueba\pruebaBundle\Entity\Clientes
     *
     * @ORM\ManyToOne(targetEntity="prueba\pruebaBundle\Entity\Clientes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idclientes", referencedColumnName="idclientes")
     * })
     */
    private $idclientes;



    /**
     * Set fechadolicitud
     *
     * @param \DateTime $fechadolicitud
     *
     * @return Solicitud
     */
    public function setFechadolicitud($fechadolicitud)
    {
        $this->fechadolicitud = $fechadolicitud;

        return $this;
    }

    /**
     * Get fechadolicitud
     *
     * @return \DateTime
     */
    public function getFechadolicitud()
    {
        return $this->fechadolicitud;
    }

    /**
     * Set fechaentrega
     *
     * @param \DateTime $fechaentrega
     *
     * @return Solicitud
     */
    public function setFechaentrega($fechaentrega)
    {
        $this->fechaentrega = $fechaentrega;

        return $this;
    }

    /**
     * Get fechaentrega
     *
     * @return \DateTime
     */
    public function getFechaentrega()
    {
        return $this->fechaentrega;
    }

    /**
     * Get idsolicitud
     *
     * @return integer
     */
    public function getIdsolicitud()
    {
        return $this->idsolicitud;
    }

    /**
     * Set idseguridad
     *
     * @param \prueba\pruebaBundle\Entity\Seguridad $idseguridad
     *
     * @return Solicitud
     */
    public function setIdseguridad(\prueba\pruebaBundle\Entity\Seguridad $idseguridad = null)
    {
        $this->idseguridad = $idseguridad;

        return $this;
    }

    /**
     * Get idseguridad
     *
     * @return \prueba\pruebaBundle\Entity\Seguridad
     */
    public function getIdseguridad()
    {
        return $this->idseguridad;
    }

    /**
     * Set idclientes
     *
     * @param \prueba\pruebaBundle\Entity\Clientes $idclientes
     *
     * @return Solicitud
     */
    public function setIdclientes(\prueba\pruebaBundle\Entity\Clientes $idclientes = null)
    {
        $this->idclientes = $idclientes;

        return $this;
    }

    /**
     * Get idclientes
     *
     * @return \prueba\pruebaBundle\Entity\Clientes
     */
    public function getIdclientes()
    {
        return $this->idclientes;
    }
}
