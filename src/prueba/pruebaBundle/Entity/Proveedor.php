<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proveedor
 *
 * @ORM\Table(name="proveedor")
 * @ORM\Entity
 */
class Proveedor
{
    /**
     * @var string
     *
     * @ORM\Column(name="proveedornombre", type="string", length=45, nullable=true)
     */
    private $proveedornombre;

    /**
     * @var string
     *
     * @ORM\Column(name="proveedorrif", type="string", length=45, nullable=true)
     */
    private $proveedorrif;

    /**
     * @var string
     *
     * @ORM\Column(name="proveedorcontacto", type="string", length=45, nullable=true)
     */
    private $proveedorcontacto;

    /**
     * @var string
     *
     * @ORM\Column(name="proveedortlf", type="string", length=45, nullable=true)
     */
    private $proveedortlf;

    /**
     * @var string
     *
     * @ORM\Column(name="proveedoremail", type="string", length=45, nullable=true)
     */
    private $proveedoremail;

    /**
     * @var string
     *
     * @ORM\Column(name="proveedorobservacion", type="text", nullable=true)
     */
    private $proveedorobservacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="idproveedor", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idproveedor;



    /**
     * Set proveedornombre
     *
     * @param string $proveedornombre
     *
     * @return Proveedor
     */
    public function setProveedornombre($proveedornombre)
    {
        $this->proveedornombre = $proveedornombre;

        return $this;
    }

    /**
     * Get proveedornombre
     *
     * @return string
     */
    public function getProveedornombre()
    {
        return $this->proveedornombre;
    }

    /**
     * Set proveedorrif
     *
     * @param string $proveedorrif
     *
     * @return Proveedor
     */
    public function setProveedorrif($proveedorrif)
    {
        $this->proveedorrif = $proveedorrif;

        return $this;
    }

    /**
     * Get proveedorrif
     *
     * @return string
     */
    public function getProveedorrif()
    {
        return $this->proveedorrif;
    }

    /**
     * Set proveedorcontacto
     *
     * @param string $proveedorcontacto
     *
     * @return Proveedor
     */
    public function setProveedorcontacto($proveedorcontacto)
    {
        $this->proveedorcontacto = $proveedorcontacto;

        return $this;
    }

    /**
     * Get proveedorcontacto
     *
     * @return string
     */
    public function getProveedorcontacto()
    {
        return $this->proveedorcontacto;
    }

    /**
     * Set proveedortlf
     *
     * @param string $proveedortlf
     *
     * @return Proveedor
     */
    public function setProveedortlf($proveedortlf)
    {
        $this->proveedortlf = $proveedortlf;

        return $this;
    }

    /**
     * Get proveedortlf
     *
     * @return string
     */
    public function getProveedortlf()
    {
        return $this->proveedortlf;
    }

    /**
     * Set proveedoremail
     *
     * @param string $proveedoremail
     *
     * @return Proveedor
     */
    public function setProveedoremail($proveedoremail)
    {
        $this->proveedoremail = $proveedoremail;

        return $this;
    }

    /**
     * Get proveedoremail
     *
     * @return string
     */
    public function getProveedoremail()
    {
        return $this->proveedoremail;
    }

    /**
     * Set proveedorobservacion
     *
     * @param string $proveedorobservacion
     *
     * @return Proveedor
     */
    public function setProveedorobservacion($proveedorobservacion)
    {
        $this->proveedorobservacion = $proveedorobservacion;

        return $this;
    }

    /**
     * Get proveedorobservacion
     *
     * @return string
     */
    public function getProveedorobservacion()
    {
        return $this->proveedorobservacion;
    }

    /**
     * Get idproveedor
     *
     * @return integer
     */
    public function getIdproveedor()
    {
        return $this->idproveedor;
    }
}
