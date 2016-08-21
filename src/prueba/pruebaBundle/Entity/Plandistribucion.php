<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plandistribucion
 *
 * @ORM\Table(name="plandistribucion", indexes={@ORM\Index(name="fk_plandistribucion_dia1_idx", columns={"iddia"}), @ORM\Index(name="fk_plandistribucion_solicitud1_idx", columns={"idsolicitud"})})
 * @ORM\Entity
 */
class Plandistribucion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idplandistribucion", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idplandistribucion;

    /**
     * @var \prueba\pruebaBundle\Entity\Solicitud
     *
     * @ORM\ManyToOne(targetEntity="prueba\pruebaBundle\Entity\Solicitud")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idsolicitud", referencedColumnName="idsolicitud")
     * })
     */
    private $idsolicitud;

    /**
     * @var \prueba\pruebaBundle\Entity\Dia
     *
     * @ORM\ManyToOne(targetEntity="prueba\pruebaBundle\Entity\Dia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="iddia", referencedColumnName="iddia")
     * })
     */
    private $iddia;



    /**
     * Get idplandistribucion
     *
     * @return integer
     */
    public function getIdplandistribucion()
    {
        return $this->idplandistribucion;
    }

    /**
     * Set idsolicitud
     *
     * @param \prueba\pruebaBundle\Entity\Solicitud $idsolicitud
     *
     * @return Plandistribucion
     */
    public function setIdsolicitud(\prueba\pruebaBundle\Entity\Solicitud $idsolicitud = null)
    {
        $this->idsolicitud = $idsolicitud;

        return $this;
    }

    /**
     * Get idsolicitud
     *
     * @return \prueba\pruebaBundle\Entity\Solicitud
     */
    public function getIdsolicitud()
    {
        return $this->idsolicitud;
    }

    /**
     * Set iddia
     *
     * @param \prueba\pruebaBundle\Entity\Dia $iddia
     *
     * @return Plandistribucion
     */
    public function setIddia(\prueba\pruebaBundle\Entity\Dia $iddia = null)
    {
        $this->iddia = $iddia;

        return $this;
    }

    /**
     * Get iddia
     *
     * @return \prueba\pruebaBundle\Entity\Dia
     */
    public function getIddia()
    {
        return $this->iddia;
    }
}
