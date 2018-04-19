<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CarroRepository extends EntityRepository{
    
    public function listaCarrosOrderedCilindrada(){
        $em=$this->getEntityManager();
        $query=$em->createQuery('SELECT p FROM AppBundle:Carro p ORDER BY p.cilindrada DESC');
    return $query->getResult();   
    }
    
   
    
}