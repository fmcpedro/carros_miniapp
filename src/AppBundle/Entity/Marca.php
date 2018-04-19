<?php

namespace AppBundle\Entity;

/**
 * Marca
 */
class Marca
{
    /**
     * @var string
     */
    private $nome;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Pais
     */
    private $pais;


    /**
     * @var \AppBundle\Entity\Modelo
     */
    private $modelos;
    
    
    
    

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return Marca
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
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
     * Set pais
     *
     * @param \AppBundle\Entity\Pais $pais
     *
     * @return Marca
     */
    public function setPais(\AppBundle\Entity\Pais $pais = null)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return \AppBundle\Entity\Pais
     */
    public function getPais()
    {
        return $this->pais;
    }
    
    
     /**
     * Get Modelo
     *
     * @return \AppBundle\Entity\Modelo
    */
    public function getModelos(){
        return $this->modelos;
    }

    
    
    
    public function __toString() {
        return $this->nome;
    }

    
    

    
}
