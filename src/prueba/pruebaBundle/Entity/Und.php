<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Und
 *
 * @ORM\Table(name="und")
 * @ORM\Entity
 */
class Und
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombreund", type="string", length=45, nullable=true)
     */
    private $nombreund;

    /**
     * @var integer
     *
     * @ORM\Column(name="valor", type="integer", nullable=true)
     */
    private $valor;

    /**
     * @var integer
     *
     * @ORM\Column(name="idund", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idund;



    /**
     * Set nombreund
     *
     * @param string $nombreund
     *
     * @return Und
     */
    public function setNombreund($nombreund)
    {
        $this->nombreund = $nombreund;

        return $this;
    }

    /**
     * Get nombreund
     *
     * @return string
     */
    public function getNombreund()
    {
        return $this->nombreund;
    }

    /**
     * Set valor
     *
     * @param integer $valor
     *
     * @return Und
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return integer
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Get idund
     *
     * @return integer
     */
    public function getIdund()
    {
        return $this->idund;
    }
}
