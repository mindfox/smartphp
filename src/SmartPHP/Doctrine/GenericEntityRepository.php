<?php
namespace SmartPHP\Doctrine;

use Doctrine\ORM\EntityRepository;

class GenericEntityRepository extends EntityRepository
{

    protected function fetchAllEntities(): array
    {
        return $this->findAll();
    }
    
    protected function fetchOneEntity($object)
    {
        return $this->find($object);
    }
    
    protected function fetchEntity($object= null)
    {
        
    }
    
    protected function addEntity($object)
    {
        $this->getEntityManager()->persist($object);
        $this->getEntityManager()->flush();
        return $object;
    }
    
    protected function updateEntity($object)
    {
        $object = $this->getEntityManager()->merge($object);
        $this->getEntityManager()->flush();
        return $object;
    }
    
    protected function removeEntity($object)
    {
        $this->getEntityManager()->remove($object);
        $this->getEntityManager()->flush();
        return $object;
    }
}