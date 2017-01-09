<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gastonomina
 *
 * @ORM\Table(name="gastonomina")
 * @ORM\Entity
 */
class Gastonomina
{
    /**
     * @var string
     *
     * @ORM\Column(name="conceptogastonomina", type="string", length=45, nullable=true)
     */
    private $conceptogastonomina;

    /**
     * @var float
     *
     * @ORM\Column(name="montogastonomina", type="float", precision=10, scale=0, nullable=true)
     */
    private $montogastonomina;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechapago", type="date", nullable=true)
     */
    private $fechapago;

    /**
     * @var integer
     *
     * @ORM\Column(name="idgastonomina", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idgastonomina;



    /**
     * Set conceptogastonomina
     *
     * @param string $conceptogastonomina
     *
     * @return Gastonomina
     */
    public function setConceptogastonomina($conceptogastonomina)
    {
        $this->conceptogastonomina = $conceptogastonomina;

        return $this;
    }

    /**
     * Get conceptogastonomina
     *
     * @return string
     */
    public function getConceptogastonomina()
    {
        return $this->conceptogastonomina;
    }

    /**
     * Set montogastonomina
     *
     * @param float $montogastonomina
     *
     * @return Gastonomina
     */
    public function setMontogastonomina($montogastonomina)
    {
        $this->montogastonomina = $montogastonomina;

        return $this;
    }

    /**
     * Get montogastonomina
     *
     * @return float
     */
    public function getMontogastonomina()
    {
        return $this->montogastonomina;
    }

    /**
     * Set fechapago
     *
     * @param \DateTime $fechapago
     *
     * @return Gastonomina
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
     * Get idgastonomina
     *
     * @return integer
     */
    public function getIdgastonomina()
    {
        return $this->idgastonomina;
    }
}
