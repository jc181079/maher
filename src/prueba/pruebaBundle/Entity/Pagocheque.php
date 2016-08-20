<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pagocheque
 *
 * @ORM\Table(name="pagocheque", indexes={@ORM\Index(name="fk_pagocheque_pagos1_idx", columns={"idpagos"})})
 * @ORM\Entity
 */
class Pagocheque
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechapago", type="date", nullable=true)
     */
    private $fechapago;

    /**
     * @var string
     *
     * @ORM\Column(name="estatuspagocheque", type="string", length=45, nullable=true)
     */
    private $estatuspagocheque;

    /**
     * @var string
     *
     * @ORM\Column(name="observacionpagocheque", type="text", nullable=true)
     */
    private $observacionpagocheque;

    /**
     * @var integer
     *
     * @ORM\Column(name="idpagocheque", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpagocheque;

    /**
     * @var \prueba\pruebaBundle\Entity\Pagos
     *
     * @ORM\ManyToOne(targetEntity="prueba\pruebaBundle\Entity\Pagos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idpagos", referencedColumnName="idpagos")
     * })
     */
    private $idpagos;



    /**
     * Set fechapago
     *
     * @param \DateTime $fechapago
     *
     * @return Pagocheque
     */
    public function setFechapago($fechapago)
    {
        $this->fechapago = $fechapago;

        return $this;
    }

    /**
     * Get fechapago
     *
     * @return \DateTime
     */
    public function getFechapago()
    {
        return $this->fechapago;
    }

    /**
     * Set estatuspagocheque
     *
     * @param string $estatuspagocheque
     *
     * @return Pagocheque
     */
    public function setEstatuspagocheque($estatuspagocheque)
    {
        $this->estatuspagocheque = $estatuspagocheque;

        return $this;
    }

    /**
     * Get estatuspagocheque
     *
     * @return string
     */
    public function getEstatuspagocheque()
    {
        return $this->estatuspagocheque;
    }

    /**
     * Set observacionpagocheque
     *
     * @param string $observacionpagocheque
     *
     * @return Pagocheque
     */
    public function setObservacionpagocheque($observacionpagocheque)
    {
        $this->observacionpagocheque = $observacionpagocheque;

        return $this;
    }

    /**
     * Get observacionpagocheque
     *
     * @return string
     */
    public function getObservacionpagocheque()
    {
        return $this->observacionpagocheque;
    }

    /**
     * Get idpagocheque
     *
     * @return integer
     */
    public function getIdpagocheque()
    {
        return $this->idpagocheque;
    }

    /**
     * Set idpagos
     *
     * @param \prueba\pruebaBundle\Entity\Pagos $idpagos
     *
     * @return Pagocheque
     */
    public function setIdpagos(\prueba\pruebaBundle\Entity\Pagos $idpagos = null)
    {
        $this->idpagos = $idpagos;

        return $this;
    }

    /**
     * Get idpagos
     *
     * @return \prueba\pruebaBundle\Entity\Pagos
     */
    public function getIdpagos()
    {
        return $this->idpagos;
    }
}
