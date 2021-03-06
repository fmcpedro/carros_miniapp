<?php

namespace AppBundle\Entity;

/**
 * Combustivel
 */
class Combustivel
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
     * @return Combustivel
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
