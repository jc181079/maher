<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cuentaxpagar
 *
 * @ORM\Table(name="cuentaxpagar", indexes={@ORM\Index(name="fk_cuentaxpagar_proveedor1_idx", columns={"idproveedor"})})
 * @ORM\Entity
 */
class Cuentaxpagar
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechacuentaxpagar", type="date", nullable=true)
     */
    private $fechacuentaxpagar;

    /**
     * @var float
     *
     * @ORM\Column(name="montocuentaxpagar", type="float", precision=10, scale=0, nullable=true)
     */
    private $montocuentaxpagar;

    /**
     * @var integer
     *
     * @ORM\Column(name="idcuentaxpagar", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcuentaxpagar;

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
     * Set fechacuentaxpagar
     *
     * @param \DateTime $fechacuentaxpagar
     *
     * @return Cuentaxpagar
     */
    public function setFechacuentaxpagar($fechacuentaxpagar)
    {
        $this->fechacuentaxpagar = $fechacuentaxpagar;

        return $this;
    }

    /**
     * Get fechacuentaxpagar
     *
     * @return \DateTime
     */
    public function getFechacuentaxpagar()
    {
        return $this->fechacuentaxpagar;
    }

    /**
     * Set montocuentaxpagar
     *
     * @param float $montocuentaxpagar
     *
     * @return Cuentaxpagar
     */
    public function setMontocuentaxpagar($montocuentaxpagar)
    {
        $this->montocuentaxpagar = $montocuentaxpagar;

        return $this;
    }

    /**
     * Get montocuentaxpagar
     *
     * @return float
     */
    public function getMontocuentaxpagar()
    {
        return $this->montocuentaxpagar;
    }

    /**
     * Get idcuentaxpagar
     *
     * @return integer
     */
    public function getIdcuentaxpagar()
    {
        return $this->idcuentaxpagar;
    }

    /**
     * Set idproveedor
     *
     * @param \prueba\pruebaBundle\Entity\Proveedor $idproveedor
     *
     * @return Cuentaxpagar
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
