<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seguridad
 *
 * @ORM\Table(name="seguridad", indexes={@ORM\Index(name="fk_seguridad_ruta1_idx", columns={"ruta_idruta"})})
 * @ORM\Entity
 */
class Seguridad
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombreusuario", type="string", length=45, nullable=true)
     */
    private $nombreusuario;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=45, nullable=true)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="pass", type="string", length=45, nullable=true)
     */
    private $pass;

    /**
     * @var string
     *
     * @ORM\Column(name="tipousuario", type="string", length=45, nullable=true)
     */
    private $tipousuario;

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
     * @ORM\Column(name="telefono", type="string", length=45, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="text", nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="contacto", type="string", length=45, nullable=true)
     */
    private $contacto;

    /**
     * @var integer
     *
     * @ORM\Column(name="idseguridad", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idseguridad;

    /**
     * @var \prueba\pruebaBundle\Entity\Ruta
     *
     * @ORM\ManyToOne(targetEntity="prueba\pruebaBundle\Entity\Ruta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ruta_idruta", referencedColumnName="idruta")
     * })
     */
    private $rutaruta;



    /**
     * Set nombreusuario
     *
     * @param string $nombreusuario
     *
     * @return Seguridad
     */
    public function setNombreusuario($nombreusuario)
    {
        $this->nombreusuario = $nombreusuario;

        return $this;
    }

    /**
     * Get nombreusuario
     *
     * @return string
     */
    public function getNombreusuario()
    {
        return $this->nombreusuario;
    }

    /**
     * Set login
     *
     * @param string $login
     *
     * @return Seguridad
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set pass
     *
     * @param string $pass
     *
     * @return Seguridad
     */
    public function setPass($pass)
    {
        $this->pass = $pass;

        return $this;
    }

    /**
     * Get pass
     *
     * @return string
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * Set tipousuario
     *
     * @param string $tipousuario
     *
     * @return Seguridad
     */
    public function setTipousuario($tipousuario)
    {
        $this->tipousuario = $tipousuario;

        return $this;
    }

    /**
     * Get tipousuario
     *
     * @return string
     */
    public function getTipousuario()
    {
        return $this->tipousuario;
    }

    /**
     * Set rif
     *
     * @param string $rif
     *
     * @return Seguridad
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
     * @return Seguridad
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
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Seguridad
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Seguridad
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set contacto
     *
     * @param string $contacto
     *
     * @return Seguridad
     */
    public function setContacto($contacto)
    {
        $this->contacto = $contacto;

        return $this;
    }

    /**
     * Get contacto
     *
     * @return string
     */
    public function getContacto()
    {
        return $this->contacto;
    }

    /**
     * Get idseguridad
     *
     * @return integer
     */
    public function getIdseguridad()
    {
        return $this->idseguridad;
    }

    /**
     * Set rutaruta
     *
     * @param \prueba\pruebaBundle\Entity\Ruta $rutaruta
     *
     * @return Seguridad
     */
    public function setRutaruta(\prueba\pruebaBundle\Entity\Ruta $rutaruta = null)
    {
        $this->rutaruta = $rutaruta;

        return $this;
    }

    /**
     * Get rutaruta
     *
     * @return \prueba\pruebaBundle\Entity\Ruta
     */
    public function getRutaruta()
    {
        return $this->rutaruta;
    }
}
