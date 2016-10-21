<?php
namespace intrawarez\smartphp\doctrine;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityRepository;
use intrawarez\smartphp\DataSourceInterface;

abstract class EntityRepositoryDataSource extends EntityRepository implements DataSourceInterface
{
    protected function isEntityInstance($object): bool
    {
        $entityClass = $this->getEntityName();
        
        return $object instanceof $entityClass;
    }
    
    protected function createCriteriaArray($object): array
    {
        if (!$this->isEntityInstance($object)) {
            throw new \InvalidArgumentException("Parameter must be instance of {$this->getEntityName()}");
        }
        
        $criteria = [];
        
        $fieldNames = array_merge(
            $this->getClassMetadata()->getFieldNames(),
            $this->getClassMetadata()->getAssociationNames()
        );
        
        $idNames = $this->getClassMetadata()->getIdentifierFieldNames();
        
        $nidNames = array_diff($fieldNames, $idNames);
                
        foreach ($nidNames as $nidName) {
            $value = $this->getClassMetadata()->getFieldValue($object, $nidName);
        
            if ($value instanceof Collection) {
                if (!$value->isEmpty()) {
                    $criteria[$nidName] = $value;
                }
            }
            else if (!empty($value)) {
                $criteria[$nidName] = $value;
            }
        }
        
        
        
        return $criteria;
    }
    
    /**
     * 
     */
    public function count()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
    
        $query = $qb->select($qb->expr()->count("e"))
            ->from($this->getEntityName(), "e")
            ->getQuery();
    
        return intval($query->getSingleScalarResult());
    
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \intrawarez\smartphp\DataSourceInterface::size()
     */
    public function size()
    {
        return $this->count();
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \intrawarez\smartphp\DataSourceInterface::fetch()
     */
    public function fetch($object = null): array
    {
        if (!is_null($object)) {
            if (!$this->isEntityInstance($object)) {
                throw new \InvalidArgumentException("Parameter must be instance of {$this->getEntityName()}");
            }
            
            if (empty($this->getClassMetadata()->getIdentifierValues($object))) {
                return $this->findBy($this->createCriteriaArray($object));
            }
            
            return $this->find($object);
        }
        
        return $this->findAll();
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \intrawarez\smartphp\DataSourceInterface::insert()
     */
    public function insert($object): array
    {
        $this->getEntityManager()->persist($object);
        
        return [$object];
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \intrawarez\smartphp\DataSourceInterface::update()
     */
    public function update($object): array
    {
        $entity = $this->getEntityManager()->merge($object);
        
        return [$entity];
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \intrawarez\smartphp\DataSourceInterface::delete()
     */
    public function delete($object): array
    {
        if (!$this->getEntityManager()->contains($object)) {
            $object = $this->find($object);
        }
        
        $this->getEntityManager()->remove($object);
        
        return [$object];
    }
}