<?php
namespace SmartPHP\Example\Repositories;

use SmartPHP\Doctrine\GenericEntityRepository;
use SmartPHP\Example\Models\Entities\DepartmentEntity;

class DepartmentRepository extends GenericEntityRepository implements DepartmentRepositoryInterface
{
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\DepartmentRepositoryInterface::fetchAll()
     */
    public function fetchAll(): array
    {
        return $this->fetchAllEntities();
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\DepartmentRepositoryInterface::fetchOne()
     */
    public function fetchOne(DepartmentEntity $department): DepartmentEntity
    {
        return $this->fetchOneEntity($department);
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\DepartmentRepositoryInterface::fetch()
     */
    public function fetch(DepartmentEntity $department = null)
    {
        return $this->fetchEntity($department);
    }
    
    /**
     *
     * @param DepartmentEntity $department
     * @return DepartmentEntity
     */
    public function add(DepartmentEntity $department): DepartmentEntity
    {
        return $this->addEntity($department);
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\DepartmentRepositoryInterface::update()
     */
    public function update(DepartmentEntity $department): DepartmentEntity
    {
        return $this->updateEntity($department);
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\DepartmentRepositoryInterface::remove()
     */
    public function remove(DepartmentEntity $department): DepartmentEntity
    {
        return $this->removeEntity($department);
    }
}