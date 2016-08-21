<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dia
 *
 * @ORM\Table(name="dia", indexes={@ORM\Index(name="fk_dia_seguridad1_idx", columns={"idseguridad"})})
 * @ORM\Entity
 */
class Dia
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="diafecha", type="date", nullable=true)
     */
    private $diafecha;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=true)
     */
    private $activo;

    /**
     * @var integer
     *
     * @ORM\Column(name="iddia", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddia;

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
     * Set diafecha
     *
     * @param \DateTime $diafecha
     *
     * @return Dia
     */
    public function setDiafecha($diafecha)
    {
        $this->diafecha = $diafecha;

        return $this;
    }

    /**
     * Get diafecha
     *
     * @return \DateTime
     */
    public function getDiafecha()
    {
        return $this->diafecha;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return Dia
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Get iddia
     *
     * @return integer
     */
    public function getIddia()
    {
        return $this->iddia;
    }

    /**
     * Set idseguridad
     *
     * @param \prueba\pruebaBundle\Entity\Seguridad $idseguridad
     *
     * @return Dia
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
