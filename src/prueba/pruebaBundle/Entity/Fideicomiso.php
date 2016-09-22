<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fideicomiso
 *
 * @ORM\Table(name="fideicomiso", indexes={@ORM\Index(name="fk_fideicomiso_proveedor1_idx", columns={"idproveedor"})})
 * @ORM\Entity
 */
class Fideicomiso
{
    /**
     * @var string
     *
     * @ORM\Column(name="fideicomisofactura", type="string", length=45, nullable=true)
     */
    private $fideicomisofactura;

    /**
     * @var float
     *
     * @ORM\Column(name="fideicomisomonto", type="float", precision=10, scale=0, nullable=true)
     */
    private $fideicomisomonto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fideicomisofecha", type="date", nullable=true)
     */
    private $fideicomisofecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="idfideicomiso", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfideicomiso;

    /**
     * @var \prueba\pruebaBundle\Entity\Proveedor
     *
     * @ORM\ManyToOne(targetEntity="prueba\pruebaBundle\Entity\Proveedor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idproveedor", referencedColumnName="idproveedor")
     * })
     */
    private $idproveedor;



    /**
     * Set fideicomisofactura
     *
     * @param string $fideicomisofactura
     *
     * @return Fideicomiso
     */
    public function setFideicomisofactura($fideicomisofactura)
    {
        $this->fideicomisofactura = $fideicomisofactura;

        return $this;
    }

    /**
     * Get fideicomisofactura
     *
     * @return string
     */
    public function getFideicomisofactura()
    {
        return $this->fideicomisofactura;
    }

    /**
     * Set fideicomisomonto
     *
     * @param float $fideicomisomonto
     *
     * @return Fideicomiso
     */
    public function setFideicomisomonto($fideicomisomonto)
    {
        $this->fideicomisomonto = $fideicomisomonto;

        return $this;
    }

    /**
     * Get fideicomisomonto
     *
     * @return float
     */
    public function getFideicomisomonto()
    {
        return $this->fideicomisomonto;
    }

    /**
     * Set fideicomisofecha
     *
     * @param \DateTime $fideicomisofecha
     *
     * @return Fideicomiso
     */
    public function setFideicomisofecha($fideicomisofecha)
    {
        $this->fideicomisofecha = $fideicomisofecha;

        return $this;
    }

    /**
     * Get fideicomisofecha
     *
     * @return \DateTime
     */
    public function getFideicomisofecha()
    {
        return $this->fideicomisofecha;
    }

    /**
     * Get idfideicomiso
     *
     * @return integer
     */
    public function getIdfideicomiso()
    {
        return $this->idfideicomiso;
    }

    /**
     * Set idproveedor
     *
     * @param \prueba\pruebaBundle\Entity\Proveedor $idproveedor
     *
     * @return Fideicomiso
     */
    public function setIdproveedor(\prueba\pruebaBundle\Entity\Proveedor $idproveedor = null)
    {
        $this->idproveedor = $idproveedor;

        return $this;
    }

    /**
     * Get idproveedor
     *
     * @return \prueba\pruebaBundle\Entity\Proveedor
     */
    public function getIdproveedor()
    {
        return $this->idproveedor;
    }
}
