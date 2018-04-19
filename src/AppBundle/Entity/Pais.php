<?php

namespace AppBundle\Entity;

/**
 * Pais
 */
class Pais
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
     * Set nome
     *
     * @param string $nome
     *
     * @return Pais
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
    
    
    public function __toString() {
        return $this->nome;
    }

    
    
}
