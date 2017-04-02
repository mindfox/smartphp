<?php
namespace SmartPHP\Doctrine;

use Doctrine\ORM\EntityRepository;

class GenericEntityRepository extends EntityRepository
{

    protected function fetchAllEntities(): array
    {
        return $this->findAll();
    }

    protected function fetchOneEntity($entity)
    {
        return $this->find($entity);
    }

    protected function fetchEntity($entity = null)
    {
        if (is_null($entity)) {
            return $this->fetchAllEntities();
        }
        return $this->fetchOneEntity($entity);
    }

    protected function addEntity($entity)
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
        return $entity;
    }

    protected function updateEntity($entity)
    {
        $entity = $this->getEntityManager()->merge($entity);
        $this->getEntityManager()->flush();
        return $entity;
    }

    protected function removeEntity($entity)
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
        return $entity;
    }
}