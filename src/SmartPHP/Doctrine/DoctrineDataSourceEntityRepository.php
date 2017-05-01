<?php
namespace SmartPHP\Doctrine;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;

abstract class DoctrineDataSourceEntityRepository extends EntityRepository
{

    public function __construct(EntityManagerInterface $entityManager, ClassMetadata $classMetadata)
    {
        parent::__construct($entityManager, $classMetadata);
    }
    
    protected function newQueryBuilder(): QueryBuilder
    {
        return $this->getEntityManager()->createQueryBuilder();
    }

    protected function newFetchEntitiesQuery(int $startRow, int $endRow): Query
    {
        $query = $this->newQueryBuilder()
            ->select("e")
            ->from($this->_entityName, "e")
            ->getQuery();
        $query->setFirstResult($startRow);
        $query->setMaxResults($endRow);
        return $query;
    }
    
    protected function newFetchEntitiesPaginator(int $startRow, int $endRow): Paginator
    {
        return new Paginator($this->newFetchEntitiesQuery($startRow, $endRow));
    }

    protected function fetchAllEntities(): \Iterator
    {
        return new \ArrayIterator($this->findAll());
    }
    
    protected function fetchEntities(int $startRow, int $endRow): \Iterator
    {
        if ($endRow < 1) {
            return $this->fetchAllEntities();
        }
        return $this->newFetchEntitiesPaginator($startRow, $endRow)->getIterator();
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
        $this->getEntityManager()->remove($this->getEntityManager()->merge($entity));
        $this->getEntityManager()->flush();
        return $entity;
    }
}
