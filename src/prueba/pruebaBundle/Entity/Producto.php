<?php

namespace prueba\pruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Producto
 *
 * @ORM\Table(name="producto", indexes={@ORM\Index(name="fk_producto_und_idx", columns={"idund"})})
 * @ORM\Entity
 */
class Producto
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombreproducto", type="string", length=45, nullable=true)
     */
    private $nombreproducto;

    /**
     * @var string
     *
     * @ORM\Column(name="marca", type="string", length=45, nullable=true)
     */
    private $marca;

    /**
     * @var string
     *
     * @ORM\Column(name="referencia", type="string", length=45, nullable=true)
     */
    private $referencia;

    /**
     * @var string
     *
     * @ORM\Column(name="familia", type="string", length=45, nullable=true)
     */
    private $familia;

    /**
     * @var integer
     *
     * @ORM\Column(name="stockmaximo", type="integer", nullable=true)
     */
    private $stockmaximo;

    /**
     * @var integer
     *
     * @ORM\Column(name="stockminimo", type="integer", nullable=true)
     */
    private $stockminimo;

    /**
     * @var float
     *
     * @ORM\Column(name="preciocosto", type="float", precision=10, scale=0, nullable=true)
     */
    private $preciocosto;

    /**
     * @var float
     *
     * @ORM\Column(name="precioventa", type="float", precision=10, scale=0, nullable=true)
     */
    private $precioventa;

    /**
     * @var integer
     *
     * @ORM\Column(name="idproducto", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idproducto;

    /**
     * @var \prueba\pruebaBundle\Entity\Und
     *
     * @ORM\ManyToOne(targetEntity="prueba\pruebaBundle\Entity\Und")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idund", referencedColumnName="idund")
     * })
     */
    private $idund;



    /**
     * Set nombreproducto
     *
     * @param string $nombreproducto
     *
     * @return Producto
     */
    public function setNombreproducto($nombreproducto)
    {
        $this->nombreproducto = $nombreproducto;

        return $this;
    }

    /**
     * Get nombreproducto
     *
     * @return string
     */
    public function getNombreproducto()
    {
        return $this->nombreproducto;
    }

    /**
     * Set marca
     *
     * @param string $marca
     *
     * @return Producto
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;

        return $this;
    }

    /**
     * Get marca
     *
     * @return string
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set referencia
     *
     * @param string $referencia
     *
     * @return Producto
     */
    public function setReferencia($referencia)
    {
        $this->referencia = $referencia;

        return $this;
    }

    /**
     * Get referencia
     *
     * @return string
     */
    public function getReferencia()
    {
        return $this->referencia;
    }

    /**
     * Set familia
     *
     * @param string $familia
     *
     * @return Producto
     */
    public function setFamilia($familia)
    {
        $this->familia = $familia;

        return $this;
    }

    /**
     * Get familia
     *
     * @return string
     */
    public function getFamilia()
    {
        return $this->familia;
    }

    /**
     * Set stockmaximo
     *
     * @param integer $stockmaximo
     *
     * @return Producto
     */
    public function setStockmaximo($stockmaximo)
    {
        $this->stockmaximo = $stockmaximo;

        return $this;
    }

    /**
     * Get stockmaximo
     *
     * @return integer
     */
    public function getStockmaximo()
    {
        return $this->stockmaximo;
    }

    /**
     * Set stockminimo
     *
     * @param integer $stockminimo
     *
     * @return Producto
     */
    public function setStockminimo($stockminimo)
    {
        $this->stockminimo = $stockminimo;

        return $this;
    }

    /**
     * Get stockminimo
     *
     * @return integer
     */
    public function getStockminimo()
    {
        return $this->stockminimo;
    }

    /**
     * Set preciocosto
     *
     * @param float $preciocosto
     *
     * @return Producto
     */
    public function setPreciocosto($preciocosto)
    {
        $this->preciocosto = $preciocosto;

        return $this;
    }

    /**
     * Get preciocosto
     *
     * @return float
     */
    public function getPreciocosto()
    {
        return $this->preciocosto;
    }

    /**
     * Set precioventa
     *
     * @param float $precioventa
     *
     * @return Producto
     */
    public function setPrecioventa($precioventa)
    {
        $this->precioventa = $precioventa;

        return $this;
    }

    /**
     * Get precioventa
     *
     * @return float
     */
    public function getPrecioventa()
    {
        return $this->precioventa;
    }

    /**
     * Get idproducto
     *
     * @return integer
     */
    public function getIdproducto()
    {
        return $this->idproducto;
    }

    /**
     * Set idund
     *
     * @param \prueba\pruebaBundle\Entity\Und $idund
     *
     * @return Producto
     */
    public function setIdund(\prueba\pruebaBundle\Entity\Und $idund = null)
    {
        $this->idund = $idund;

        return $this;
    }

    /**
     * Get idund
     *
     * @return \prueba\pruebaBundle\Entity\Und
     */
    public function getIdund()
    {
        return $this->idund;
    }
}
