<?php

namespace AppBundle\Entity;

<<<<<<< HEAD
//te afghsgdfetregdv
=======
//test fsdsdfdd
>>>>>>> 41efaccee1b6f1cf575980a139c78b197fb47cbf
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Carro
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Carro
{
    /**
     * @var string
     */
    private $cilindrada;

    /**
     * @var datetime
     */
    private $dataVenda;

    /**
     * @var string
     */
    private $observacoes;

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
     * @Vich\UploadableField(mapping="carro_image", fileNameProperty="imageName")
     * @var File
     * 
     */
    private $imageFile;
   
    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $imageName;
    
    
    
    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;
    
    
    
    /**
     * @var \AppBundle\Entity\User
     */
    private $user;
    
    
    private $private; //boolean ->voter
    
    /**
     * Set cilindrada
     *
     * @param string $cilindrada
     *
     * @return Carro
     */
    public function setCilindrada($cilindrada)
    {
        $this->cilindrada = $cilindrada;

        return $this;
    }

    /**
     * Get cilindrada
     *
     * @return string
     */
    public function getCilindrada()
    {
        return $this->cilindrada;
    }

    /**
     * Set dataVenda
     *
     * @param datetime $dataVenda
     *
     * @return Carro
     */
    public function setDataVenda($dataVenda)
    {
        $this->dataVenda = $dataVenda;

        return $this;
    }

    /**
     * Get dataVenda
     *
     * @return Carro
     */
    public function getDataVenda()
    {
        return $this->dataVenda;
    }

    /**
     * Set observacoes
     *
     * @param string $observacoes
     *
     * @return Carro
     */
    public function setObservacoes($observacoes)
    {
        $this->observacoes = $observacoes;

        return $this;
    }

    /**
     * Get observacoes
     *
     * @return string
     */
    public function getObservacoes()
    {
        return $this->observacoes;
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
     * @return Carro
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
     * @return Carro
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
     * @return Carro
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
    
    public function __toString() {
        return $this->id;
    }

    
    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImageFile(File $image = null)//: void
    {
        $this->imageFile = $image;

        if (null !== $image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile()//: File
    {
        return $this->imageFile;
    }

    public function setImageName(string $imageName)// : void
    {
        $this->imageName = $imageName;
    }

    public function getImageName()//: string
    {
        return $this->imageName;
    }
    
    function getUpdatedAt(): \DateTime {
        return $this->updatedAt;
    }

    function setUpdatedAt(\DateTime $updatedAt) {
        $this->updatedAt = $updatedAt;
    }


    function getUser() {
        return $this->user;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function isPrivate() { //voter -> definir como ver ou esconder os carros
        $loggeduser = $this->getUser();
        $private= true;
        
        if( $this->getId() == $loggeduser ) {
            $private = false;
        }else{
            $private = true;
        }
        return $private;
    }

        



    
    
    
}
    
