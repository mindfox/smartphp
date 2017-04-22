<?php
namespace SmartPHP\Doctrine;

use Doctrine\ORM\EntityRepository;

abstract class DoctrineDataSourceEntityRepository extends EntityRepository
{

    protected function fetchAllEntities(): array
    {
        return $this->findAll();
    }

    protected function fetchEntities(int $startRow, int $endRow): array
    {
        return $this->findBy([], null, $startRow, $endRow);
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
        $this->getEntityManager()->persist($this->removeEntity($entity));
        $this->getEntityManager()->flush();
        return $entity;
    }
}
