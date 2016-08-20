<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Clientes
 *
 * @ORM\Table(name="clientes", indexes={@ORM\Index(name="fk_clientes_ruta1_idx", columns={"idruta"})})
 * @ORM\Entity
 */
class Clientes
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombrecliente", type="string", length=45, nullable=true)
     */
    private $nombrecliente;

    /**
     * @var string
     *
     * @ORM\Column(name="rif", type="string", length=10, nullable=true)
     */
    private $rif;

    /**
     * @var string
     *
     * @ORM\Column(name="tipocliente", type="string", length=45, nullable=true)
     */
    private $tipocliente;

    /**
     * @var string
     *
     * @ORM\Column(name="telefonocliente", type="string", length=45, nullable=true)
     */
    private $telefonocliente;

    /**
     * @var string
     *
     * @ORM\Column(name="direccioncliente", type="text", nullable=true)
     */
    private $direccioncliente;

    /**
     * @var string
     *
     * @ORM\Column(name="contactocliente", type="string", length=45, nullable=true)
     */
    private $contactocliente;

    /**
     * @var integer
     *
     * @ORM\Column(name="idclientes", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idclientes;

    /**
     * @var \prueba\pruebaBundle\Entity\Ruta
     *
     * @ORM\ManyToOne(targetEntity="prueba\pruebaBundle\Entity\Ruta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idruta", referencedColumnName="idruta")
     * })
     */
    private $idruta;



    /**
     * Set nombrecliente
     *
     * @param string $nombrecliente
     *
     * @return Clientes
     */
    public function setNombrecliente($nombrecliente)
    {
        $this->nombrecliente = $nombrecliente;

        return $this;
    }

    /**
     * Get nombrecliente
     *
     * @return string
     */
    public function getNombrecliente()
    {
        return $this->nombrecliente;
    }

    /**
     * Set rif
     *
     * @param string $rif
     *
     * @return Clientes
     */
    public function setRif($rif)
    {
        $this->rif = $rif;

        return $this;
    }

    /**
     * Get rif
     *
     * @return string
     */
    public function getRif()
    {
        return $this->rif;
    }

    /**
     * Set tipocliente
     *
     * @param string $tipocliente
     *
     * @return Clientes
     */
    public function setTipocliente($tipocliente)
    {
        $this->tipocliente = $tipocliente;

        return $this;
    }

    /**
     * Get tipocliente
     *
     * @return string
     */
    public function getTipocliente()
    {
        return $this->tipocliente;
    }

    /**
     * Set telefonocliente
     *
     * @param string $telefonocliente
     *
     * @return Clientes
     */
    public function setTelefonocliente($telefonocliente)
    {
        $this->telefonocliente = $telefonocliente;

        return $this;
    }

    /**
     * Get telefonocliente
     *
     * @return string
     */
    public function getTelefonocliente()
    {
        return $this->telefonocliente;
    }

    /**
     * Set direccioncliente
     *
     * @param string $direccioncliente
     *
     * @return Clientes
     */
    public function setDireccioncliente($direccioncliente)
    {
        $this->direccioncliente = $direccioncliente;

        return $this;
    }

    /**
     * Get direccioncliente
     *
     * @return string
     */
    public function getDireccioncliente()
    {
        return $this->direccioncliente;
    }

    /**
     * Set contactocliente
     *
     * @param string $contactocliente
     *
     * @return Clientes
     */
    public function setContactocliente($contactocliente)
    {
        $this->contactocliente = $contactocliente;

        return $this;
    }

    /**
     * Get contactocliente
     *
     * @return string
     */
    public function getContactocliente()
    {
        return $this->contactocliente;
    }

    /**
     * Get idclientes
     *
     * @return integer
     */
    public function getIdclientes()
    {
        return $this->idclientes;
    }

    /**
     * Set idruta
     *
     * @param \prueba\pruebaBundle\Entity\Ruta $idruta
     *
     * @return Clientes
     */
    public function setIdruta(\prueba\pruebaBundle\Entity\Ruta $idruta = null)
    {
        $this->idruta = $idruta;

        return $this;
    }

    /**
     * Get idruta
     *
     * @return \prueba\pruebaBundle\Entity\Ruta
     */
    public function getIdruta()
    {
        return $this->idruta;
    }
}
