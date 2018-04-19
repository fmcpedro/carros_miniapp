<?php

namespace AppBundle\Entity;
//use FOS\UserBundle\Entity\User as BaseUser;

use FOS\UserBundle\Model\User as BaseUser;

class User extends BaseUser
{

    protected $id;

    protected $nome;
    
    protected $morada;
    
    protected $listacarros;
    
//
//    public function __construct()
//    {
//        parent::__construct();
//    }
    
    
//    function getId() {
//        return $this->id;
//    }

    function getNome() {
        return $this->nome;
    }

    function getListacarros() {
        return $this->listacarros;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setListacarros($listacarros) {
        $this->listacarros = $listacarros;
    }

//    public function __toString() {
//        return $this->id;
//    }

    
}