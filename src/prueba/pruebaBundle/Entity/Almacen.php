<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Almacen
 *
 * @ORM\Table(name="almacen")
 * @ORM\Entity
 */
class Almacen
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombrealmacen", type="string", length=45, nullable=true)
     */
    private $nombrealmacen;

    /**
     * @var integer
     *
     * @ORM\Column(name="idalmacen", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idalmacen;



    /**
     * Set nombrealmacen
     *
     * @param string $nombrealmacen
     *
     * @return Almacen
     */
    public function setNombrealmacen($nombrealmacen)
    {
        $this->nombrealmacen = $nombrealmacen;

        return $this;
    }

    /**
     * Get nombrealmacen
     *
     * @return string
     */
    public function getNombrealmacen()
    {
        return $this->nombrealmacen;
    }

    /**
     * Get idalmacen
     *
     * @return integer
     */
    public function getIdalmacen()
    {
        return $this->idalmacen;
    }
}
