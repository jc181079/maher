<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Solicitud
 *
 * @ORM\Table(name="solicitud")
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
     * @var string
     *
     * @ORM\Column(name="estatus", type="string", length=45, nullable=true)
     */
    private $estatus;

    /**
     * @var string
     *
     * @ORM\Column(name="numerosolicitud", type="string", length=45, nullable=true)
     */
    private $numerosolicitud;

    /**
     * @var string
     *
     * @ORM\Column(name="tipopago", type="string", length=45, nullable=true)
     */
    private $tipopago;

    /**
     * @var string
     *
     * @ORM\Column(name="prioridad", type="string", length=5, nullable=true)
     */
    private $prioridad;

    /**
     * @var string
     *
     * @ORM\Column(name="rif", type="string", length=10, nullable=true)
     */
    private $rif;

    /**
     * @var integer
     *
     * @ORM\Column(name="idsolicitud", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsolicitud;



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
     * Set estatus
     *
     * @param string $estatus
     *
     * @return Solicitud
     */
    public function setEstatus($estatus)
    {
        $this->estatus = $estatus;

        return $this;
    }

    /**
     * Get estatus
     *
     * @return string
     */
    public function getEstatus()
    {
        return $this->estatus;
    }

    /**
     * Set numerosolicitud
     *
     * @param string $numerosolicitud
     *
     * @return Solicitud
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
     * Set tipopago
     *
     * @param string $tipopago
     *
     * @return Solicitud
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
     * Set prioridad
     *
     * @param string $prioridad
     *
     * @return Solicitud
     */
    public function setPrioridad($prioridad)
    {
        $this->prioridad = $prioridad;

        return $this;
    }

    /**
     * Get prioridad
     *
     * @return string
     */
    public function getPrioridad()
    {
        return $this->prioridad;
    }

    /**
     * Set rif
     *
     * @param string $rif
     *
     * @return Solicitud
     */
    public function setRif($rif)
    {
        $this->rif = $rif;

        return $this;
    }

    /**
     * Get rif
     *
     * @return string
     */
    public function getRif()
    {
        return $this->rif;
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
}
