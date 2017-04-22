<?php
namespace SmartPHP\Doctrine;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use SmartPHP\AbstractDataSourceAdapter;

class DoctrineObjectRepositoryDataSourceAdapter extends AbstractDataSourceAdapter
{


    /**
     * 
     * @var EntityManagerInterface
     */
    private $entityManager;
    
    /**
     *
     * @var ObjectRepository
     */
    private $objectRepository;

    /**
     *
     * @var \ReflectionClass
     */
    private $objectRepositoryReclector;

    public function __construct(EntityManagerInterface $entityManager, ObjectRepository $objectRepository)
    {
        parent::__construct($objectRepository);
        $this->entityManager = $entityManager;
        
    }

    
    
    private function defaultFetch($entity = null)
    {
        if (is_null($entity)) {
            return $this->objectRepository->findAll();
        }
        return $this->objectRepository->find($entity);
    }
    
    private function defaultAdd($entity)
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }
    
    private function defaultUpdate($entity)
    {
        $entity = $this->entityManager->merge($entity);
        $this->entityManager->flush();
        return $entity;
    }
    
    private function defaultRemove($entity)
    {
        $this->entityManager->remove($this->entityManager->merge($entity));
        $this->entityManager->flush();
        return $entity;
    }

    public function fetch($entity = null)
    {
        if ($this->hasFetchMethod()) {
            return $this->invokeFetchMethod($entity);
        }
        return $this->defaultFetch($entity);
    }
    
    public function add($entity)
    {
        if ($this->hasAddMethod()) {
            return $this->invokeAddMethod($entity);
        }
        return $this->defaultAdd($entity);
    }
    
    public function update($entity)
    {
        if ($this->hasUpdateMethod()) {
            return $this->invokeUpdateMethod($entity);
        }
        return $this->defaultUpdate($entity);
    }
    
    public function remove($entity)
    {
        if ($this->hasRemoveMethod()) {
            return $this->invokeRemoveMethod($entity);
        }
        return $this->defaultRemove($entity);
    }
}
