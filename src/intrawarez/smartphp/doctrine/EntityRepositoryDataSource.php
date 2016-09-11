<?php
namespace intrawarez\smartphp\doctrine;

use Doctrine\ORM\EntityRepository;
use intrawarez\smartphp\DataSourceInterface;

abstract class EntityRepositoryDataSource extends EntityRepository implements DataSourceInterface
{
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
    public function fetch()
    {   
        return $this->findAll();
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \intrawarez\smartphp\DataSourceInterface::insert()
     */
    public function insert($object)
    {
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
        $this->getEntityManager()->remove($object);
    }
}