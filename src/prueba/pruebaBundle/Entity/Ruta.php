<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ruta
 *
 * @ORM\Table(name="ruta")
 * @ORM\Entity
 */
class Ruta
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombreruta", type="string", length=45, nullable=true)
     */
    private $nombreruta;

    /**
     * @var string
     *
     * @ORM\Column(name="detalleruta", type="text", nullable=true)
     */
    private $detalleruta;

    /**
     * @var integer
     *
     * @ORM\Column(name="idruta", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idruta;



    /**
     * Set nombreruta
     *
     * @param string $nombreruta
     *
     * @return Ruta
     */
    public function setNombreruta($nombreruta)
    {
        $this->nombreruta = $nombreruta;

        return $this;
    }

    /**
     * Get nombreruta
     *
     * @return string
     */
    public function getNombreruta()
    {
        return $this->nombreruta;
    }

    /**
     * Set detalleruta
     *
     * @param string $detalleruta
     *
     * @return Ruta
     */
    public function setDetalleruta($detalleruta)
    {
        $this->detalleruta = $detalleruta;

        return $this;
    }

    /**
     * Get detalleruta
     *
     * @return string
     */
    public function getDetalleruta()
    {
        return $this->detalleruta;
    }

    /**
     * Get idruta
     *
     * @return integer
     */
    public function getIdruta()
    {
        return $this->idruta;
    }
}
