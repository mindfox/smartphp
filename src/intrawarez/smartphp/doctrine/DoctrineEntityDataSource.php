<?php
namespace intrawarez\smartphp;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

abstract class DoctrineEntityDataSource implements DataSourceInterface
{
    private $entityClass;
    
    /**
     * 
     * @var EntityManager
     */
    private $entityManager;
    
    /**
     * 
     * @var EntityRepository
     */
    private $entityRepository;
    
    public function __construct(EntityManager $entityManager, $entityClass)
    {
        $this->entityClass = $entityClass;
        $this->entityManager = $entityManager;
        $this->entityRepository = $entityManager->getRepository($entityClass);
    }
    
    /**
     * 
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }
    
    /**
     * 
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getEntityRepository()
    {
        return $this->entityRepository;
    }
    
    public function count()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
    
        $query = $qb->select($qb->expr()->count("e"))
            ->from($this->entityClass, "e")
            ->getQuery();
    
        return intval($query->getSingleScalarResult());
    
    }
    
    public function size()
    {
        return $this->count();
    }
    
    public function fetch()
    {
        if (method_exists($this->getEntityRepository(), "findAll")) {
            return $this->getEntityRepository()->findAll();
        }
        
        return $this->getEntityRepository()->findAll();
    }
    
    public function insert($object)
    {
        if (!($object instanceof $this->entityClass)) {
            throw new \InvalidArgumentException("Insert expects parameter to of type '{$this->entityClass}'");
        }
            
        if (method_exists($this->getEntityRepository(), "insert")) {
            return $this->getEntityRepository()->insert($object);
        }
        
        $this->getEntityManager()->persist($object);
        $this->getEntityManager()->flush();
        
        return $object;
    }
    
    public function update($object)
    {
        if (method_exists($this->getEntityRepository(), "update")) {
            return $this->getEntityRepository()->update($object);
        }
        
        $entity = $this->getEntityManager()->merge($object);
        
        $this->getEntityManager()->flush();
        
        return $entity;
    }
    
    public function delete($object)
    {
        if (method_exists($this->getEntityRepository(), "delete")) {
            return $this->getEntityRepository()->delete($object);
        }
        
        $this->getEntityManager()->remove($object);
        $this->getEntityManager()->flush();
    }
}