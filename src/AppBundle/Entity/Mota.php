<?php

namespace AppBundle\Entity;

/**
 * Mota
 */
class Mota
{
    /**
     * @var float
     */
    private $peso;


    /**
     * @var integer
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Combustivel
     */
    private $combustivel;

    /**
     * @var \AppBundle\Entity\Cor
     */
    private $cor;

    /**
     * @var \AppBundle\Entity\Modelo
     */
    private $modelo;

    /**
     * @var \AppBundle\Entity\Numerorodas
     */
    private $numerorodas;


    /**
     * Set peso
     *
     * @param float $peso
     *
     * @return Mota
     */
    public function setPeso($peso)
    {
        $this->peso = $peso;

        return $this;
    }

    /**
     * Get peso
     *
     * @return float
     */
    public function getPeso()
    {
        return $this->peso;
    }



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set combustivel
     *
     * @param \AppBundle\Entity\Combustivel $combustivel
     *
     * @return Mota
     */
    public function setCombustivel(\AppBundle\Entity\Combustivel $combustivel = null)
    {
        $this->combustivel = $combustivel;

        return $this;
    }

    /**
     * Get combustivel
     *
     * @return \AppBundle\Entity\Combustivel
     */
    public function getCombustivel()
    {
        return $this->combustivel;
    }

    /**
     * Set cor
     *
     * @param \AppBundle\Entity\Cor $cor
     *
     * @return Mota
     */
    public function setCor(\AppBundle\Entity\Cor $cor = null)
    {
        $this->cor = $cor;

        return $this;
    }

    /**
     * Get cor
     *
     * @return \AppBundle\Entity\Cor
     */
    public function getCor()
    {
        return $this->cor;
    }

    /**
     * Set modelo
     *
     * @param \AppBundle\Entity\Modelo $modelo
     *
     * @return Mota
     */
    public function setModelo(\AppBundle\Entity\Modelo $modelo = null)
    {
        $this->modelo = $modelo;

        return $this;
    }

    /**
     * Get modelo
     *
     * @return \AppBundle\Entity\Modelo
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Set numerorodas
     *
     * @param \AppBundle\Entity\Numerorodas $numerorodas
     *
     * @return Mota
     */
    public function setNumerorodas(\AppBundle\Entity\Numerorodas $numerorodas = null)
    {
        $this->numerorodas = $numerorodas;

        return $this;
    }

    /**
     * Get numerorodas
     *
     * @return \AppBundle\Entity\Numerorodas
     */
    public function getNumerorodas()
    {
        return $this->numerorodas;
    }
    
    public function __toString() {
        return $this->cor;
    }

    
    
    
}
