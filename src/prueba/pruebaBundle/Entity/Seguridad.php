<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seguridad
 *
 * @ORM\Table(name="seguridad")
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
     * @var integer
     *
     * @ORM\Column(name="idseguridad", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idseguridad;



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
     * Get idseguridad
     *
     * @return integer
     */
    public function getIdseguridad()
    {
        return $this->idseguridad;
    }
}
