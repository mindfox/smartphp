<?php
namespace SmartPHP\Doctrine;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use SmartPHP\Interfaces\OptionalInterface;
use SmartPHP\DefaultImpl\Optional;

class DoctrineDataSourceRepository
{

    /**
     *
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }
    
    protected function getClassOf($entity)
    {
        return get_class($entity);
    }

    protected function getObjectRepository($class): ObjectRepository
    {
        return $this->getEntityManager()->getRepository($class);
    }
    
    protected function getDataSource($class)
    {
        return new GenericEntityRepository($this->getEntityManager(), $this->getObjectRepository($class));
    }
    
    protected function getEntitySource($entity)
    {
        return $this->getDataSource($this->getClassOf($entity));
    }

    protected function fetchAllEntities(string $class)
    {
        return $this->getObjectRepository($class)->findAll();
    }

    protected function fetchOneEntity($entity): OptionalInterface
    {
        $class = $this->getClassOf($entity);
        return Optional::Of($this->getObjectRepository($class)->find($entity));
    }
    
    protected function fetchEntity($entity = null)
    {
        if (is_null($entity)) {
            $class = $this->getClassOf($entity);
            return $this->fetchAllEntities($class);
        }
        return $this->fetchOneEntity($entity);
    }

    protected function addEntity($entity)
    {
        return $this->getEntitySource($entity)->add($entity);
    }

    protected function updateEntity($entity)
    {
        return $this->getEntitySource($entity)->update($entity);
    }

    protected function removeEntity($entity)
    {
        return $this->getEntitySource($entity)->remove($entity);
    }
}
