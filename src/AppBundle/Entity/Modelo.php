<?php

namespace AppBundle\Entity;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use AppBundle\Validator\Constraints\ValidName;

/**
 * Modelo
 */
class Modelo
{
    /**
     * @var string
     *
     */
    private $nome;

    
     /**
     * @var datetime
     */
    public $dataInicioFabrico;

    
    /**
     * @var datetime
     */
    public $dataFimFabrico;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Marca
     */
    private $marca;

    /**
     * @var \AppBundle\Entity\Carro
     */
    private $carros;

    /**
     * Get carros
     *
     * @return \AppBundle\Entity\Carro
     */
    public function getCarros() {
        return $this->carros;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return Modelo
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
     * Set dataInicioFabrico
     *
     * @param datetime $dataInicioFabrico
     *
     * @return Modelo
     */
    public function setDataInicioFabrico($dataInicioFabrico)
    {
        $this->dataInicioFabrico = $dataInicioFabrico;

        return $this;
    }

    /**
     * Get dataInicioFabrico
     *
     * @return Modelo
     */
    public function getDataInicioFabrico()
    {
        return $this->dataInicioFabrico;
    }

    /**
     * Set dataFimFabrico
     *
     * @param datetime $dataFimFabrico
     *
     * @return Modelo
     */
    public function setDataFimFabrico($dataFimFabrico)
    {
        $this->dataFimFabrico = $dataFimFabrico;

        return $this;
    }

    /**
     * Get dataFimFabrico
     *
     * @return Modelo
     */
    public function getDataFimFabrico()
    {
        return $this->dataFimFabrico;
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
     * Set marca
     *
     * @param \AppBundle\Entity\Marca $marca
     *
     * @return Modelo
     */
    public function setMarca(\AppBundle\Entity\Marca $marca = null)
    {
        $this->marca = $marca;

        return $this;
    }

    /**
     * Get marca
     *
     * @return \AppBundle\Entity\Marca
     */
    public function getMarca()
    {
        return $this->marca;
    }
    
    public function __toString() {
        return $this->nome;
    }
    
        public static function loadValidatorMetadata(ClassMetadata $metadata){
             $metadata->addConstraint(new Callback('validateDates'));
             $metadata->addPropertyConstraint('nome',new ValidName());
        }
    
    public function validateDates(ExecutionContextInterface $context){
       if (($this->getDataFimFabrico()->getTimeStamp()) <= ($this->getDataInicioFabrico()->getTimestamp())) {
            $context->buildViolation('A data de início de produção tem de ser anterior à data de fim de produção.')
                ->atPath('dataInicioFabrico')
                ->addViolation();
       }
    }
    
    
     
    }
    
    

 
