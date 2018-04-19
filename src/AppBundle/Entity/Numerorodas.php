<?php

namespace AppBundle\Entity;

/**
 * Numerorodas
 */
class Numerorodas
{
    /**
     * @var string
     */
    private $numerorodascol;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set numerorodascol
     *
     * @param string $numerorodascol
     *
     * @return Numerorodas
     */
    public function setNumerorodascol($numerorodascol)
    {
        $this->numerorodascol = $numerorodascol;

        return $this;
    }

    /**
     * Get numerorodascol
     *
     * @return string
     */
    public function getNumerorodascol()
    {
        return $this->numerorodascol;
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
        return $this->numerorodascol;
    }

    
}
