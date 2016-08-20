<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gastosoperativos
 *
 * @ORM\Table(name="gastosoperativos", indexes={@ORM\Index(name="fk_gastosoperativos_plandistribucion1_idx", columns={"idplandistribucion"})})
 * @ORM\Entity
 */
class Gastosoperativos
{
    /**
     * @var string
     *
     * @ORM\Column(name="conceptogasto", type="string", length=45, nullable=true)
     */
    private $conceptogasto;

    /**
     * @var string
     *
     * @ORM\Column(name="facturagasto", type="string", length=45, nullable=true)
     */
    private $facturagasto;

    /**
     * @var string
     *
     * @ORM\Column(name="montogasto", type="string", length=45, nullable=true)
     */
    private $montogasto;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="text", nullable=true)
     */
    private $observacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="idgastosoperativos", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idgastosoperativos;

    /**
     * @var \prueba\pruebaBundle\Entity\Plandistribucion
     *
     * @ORM\ManyToOne(targetEntity="prueba\pruebaBundle\Entity\Plandistribucion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idplandistribucion", referencedColumnName="idplandistribucion")
     * })
     */
    private $idplandistribucion;



    /**
     * Set conceptogasto
     *
     * @param string $conceptogasto
     *
     * @return Gastosoperativos
     */
    public function setConceptogasto($conceptogasto)
    {
        $this->conceptogasto = $conceptogasto;

        return $this;
    }

    /**
     * Get conceptogasto
     *
     * @return string
     */
    public function getConceptogasto()
    {
        return $this->conceptogasto;
    }

    /**
     * Set facturagasto
     *
     * @param string $facturagasto
     *
     * @return Gastosoperativos
     */
    public function setFacturagasto($facturagasto)
    {
        $this->facturagasto = $facturagasto;

        return $this;
    }

    /**
     * Get facturagasto
     *
     * @return string
     */
    public function getFacturagasto()
    {
        return $this->facturagasto;
    }

    /**
     * Set montogasto
     *
     * @param string $montogasto
     *
     * @return Gastosoperativos
     */
    public function setMontogasto($montogasto)
    {
        $this->montogasto = $montogasto;

        return $this;
    }

    /**
     * Get montogasto
     *
     * @return string
     */
    public function getMontogasto()
    {
        return $this->montogasto;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     *
     * @return Gastosoperativos
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * Get observacion
     *
     * @return string
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Get idgastosoperativos
     *
     * @return integer
     */
    public function getIdgastosoperativos()
    {
        return $this->idgastosoperativos;
    }

    /**
     * Set idplandistribucion
     *
     * @param \prueba\pruebaBundle\Entity\Plandistribucion $idplandistribucion
     *
     * @return Gastosoperativos
     */
    public function setIdplandistribucion(\prueba\pruebaBundle\Entity\Plandistribucion $idplandistribucion = null)
    {
        $this->idplandistribucion = $idplandistribucion;

        return $this;
    }

    /**
     * Get idplandistribucion
     *
     * @return \prueba\pruebaBundle\Entity\Plandistribucion
     */
    public function getIdplandistribucion()
    {
        return $this->idplandistribucion;
    }
}
