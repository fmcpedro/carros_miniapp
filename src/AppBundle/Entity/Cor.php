<?php

namespace AppBundle\Entity;

/**
 * Cor
 */
class Cor
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
     * @return Cor
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

    
    function __construct($nome, $id) {
        $this->nome = $nome;
        $this->id = $id;
    }

    
    
}
