<?php
namespace intrawarez\smartphp\doctrine;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityRepository;
use intrawarez\smartphp\datasource\DataSourceInterface;
use intrawarez\smartphp\datasource\DSTextMatchStyle;

/**
 * The DataSource implemenation for Doctrine2 entity repositories.
 * @author maxmeffert
 */
abstract class EntityRepositoryDataSource extends EntityRepository implements DataSourceInterface
{
    /**
     * @param mixed $object
     * @return bool
     */
    protected function isEntityInstance($object): bool
    {
        $entityClass = $this->getEntityName();
        
        return $object instanceof $entityClass;
    }
    
    /**
     * @param mixed $object
     * @throws \InvalidArgumentException
     */
    protected function assertEntityInstance($object)
    {
        if (!$this->isEntityInstance($object)) {
            throw new \InvalidArgumentException("Parameter must be instance of {$this->getEntityName()}");
        }
    }
    
    /**
     * @param object $object
     * @return bool
     */
    protected function isIdentifiable($object): bool
    {
        return !empty($this->getClassMetadata()->getIdentifierValues($object));
    }
    
    /**
     * 
     * @param object $object
     * @throws \InvalidArgumentException
     * @return array
     */
    protected function createCriteriaArray($object): array
    {
        $this->assertEntityInstance($object);
        
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
     * @param object $object
     * @return Criteria
     */
    protected function createCriteria($object): Criteria
    {
        $exprBuilder = Criteria::expr();
        $exprArray = [];
        
        foreach ($this->createCriteriaArray($object) as $field => $value) {
            $exprArray[] = $exprBuilder->contains($field, $value);
        }
        
        $expression = call_user_func_array([$exprBuilder,"andX"], $exprArray);
        
        return Criteria::create()->where($expression);
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
    public function fetch($object = null, $textMatchStyle = DSTextMatchStyle::EXACT)
    {
        if (is_null($object)) {
            return $this->findAll();
        }
        
        $this->assertEntityInstance($object);
        
        if ($this->isIdentifiable($object)) {
            return $this->find($object);
        }
        
        if ($textMatchStyle == DSTextMatchStyle::EXACT) {
            return $this->findBy($this->createCriteriaArray($object));
        }
        
        return $this->matching($this->createCriteria($object));
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \intrawarez\smartphp\DataSourceInterface::insert()
     */
    public function insert($object)
    {
        $this->assertEntityInstance($object);
        $this->getEntityManager()->persist($object);
        return $object;
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \intrawarez\smartphp\DataSourceInterface::update()
     */
    public function update($object)
    {
        $this->assertEntityInstance($object);
        $entity = $this->getEntityManager()->merge($object);
        return $entity;
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \intrawarez\smartphp\DataSourceInterface::delete()
     */
    public function delete($object)
    {
        $this->assertEntityInstance($object);
        if (!$this->getEntityManager()->contains($object)) {
            $object = $this->find($object);
        }
        $this->getEntityManager()->remove($object);
        return $object;
    }
}