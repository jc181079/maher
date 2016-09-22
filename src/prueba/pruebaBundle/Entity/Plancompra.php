<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plancompra
 *
 * @ORM\Table(name="plancompra", indexes={@ORM\Index(name="fk_plancompra_seguridad1_idx", columns={"idseguridad"})})
 * @ORM\Entity
 */
class Plancompra
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="plancomprafecha", type="date", nullable=true)
     */
    private $plancomprafecha;

    /**
     * @var string
     *
     * @ORM\Column(name="plancompraestatus", type="string", length=45, nullable=true)
     */
    private $plancompraestatus;

    /**
     * @var integer
     *
     * @ORM\Column(name="idplancompra", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idplancompra;

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
     * Set plancomprafecha
     *
     * @param \DateTime $plancomprafecha
     *
     * @return Plancompra
     */
    public function setPlancomprafecha($plancomprafecha)
    {
        $this->plancomprafecha = $plancomprafecha;

        return $this;
    }

    /**
     * Get plancomprafecha
     *
     * @return \DateTime
     */
    public function getPlancomprafecha()
    {
        return $this->plancomprafecha;
    }

    /**
     * Set plancompraestatus
     *
     * @param string $plancompraestatus
     *
     * @return Plancompra
     */
    public function setPlancompraestatus($plancompraestatus)
    {
        $this->plancompraestatus = $plancompraestatus;

        return $this;
    }

    /**
     * Get plancompraestatus
     *
     * @return string
     */
    public function getPlancompraestatus()
    {
        return $this->plancompraestatus;
    }

    /**
     * Get idplancompra
     *
     * @return integer
     */
    public function getIdplancompra()
    {
        return $this->idplancompra;
    }

    /**
     * Set idseguridad
     *
     * @param \prueba\pruebaBundle\Entity\Seguridad $idseguridad
     *
     * @return Plancompra
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
}
