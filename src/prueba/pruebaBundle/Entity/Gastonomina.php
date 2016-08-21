<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gastonomina
 *
 * @ORM\Table(name="gastonomina", indexes={@ORM\Index(name="fk_gastonomina_plandistribucion1_idx", columns={"idplandistribucion"})})
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
     * @var integer
     *
     * @ORM\Column(name="idgastonomina", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idgastonomina;

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
     * Get idgastonomina
     *
     * @return integer
     */
    public function getIdgastonomina()
    {
        return $this->idgastonomina;
    }

    /**
     * Set idplandistribucion
     *
     * @param \prueba\pruebaBundle\Entity\Plandistribucion $idplandistribucion
     *
     * @return Gastonomina
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
