<?php
namespace SmartPHP\Doctrine;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
class GenericDataSourceRepository
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

    protected function getObjectRepository($class): ObjectRepository
    {
        return $this->getEntityManager()->getRepository($class);
    }
    
    protected function getClassOf($entity)
    {
        return get_class($entity);
    }

    protected function fetchAllEntities(string $class)
    {
        return $this->getObjectRepository($class)->findAll();
    }

    protected function fetchOneEntity($entity)
    {
        $class = $this->getClassOf($entity);
        return $this->getObjectRepository($class)->find($entity);
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