<?php
namespace SmartPHP\Example\Repositories;

use SmartPHP\Doctrine\GenericDataSourceRepository;
use SmartPHP\Example\Models\Entities\EmployeeEntity;

class EmployeeRepository extends GenericDataSourceRepository implements EmployeeRepositoryInterface
{
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\EmployeeRepositoryInterface::fetchAll()
     */
    public function fetchAll(): array
    {
        return $this->fetchAllEntities(EmployeeEntity::class);
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\EmployeeRepositoryInterface::fetchOne()
     */
    public function fetchOne(EmployeeEntity $employee): EmployeeEntity
    {
        return $this->fetchOneEntity($employee);
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\EmployeeRepositoryInterface::fetch()
     */
    public function fetch(EmployeeEntity $employee = null)
    {
        return $this->fetchEntity($employee);
    }
    
    /**
     *
     * @param EmployeeEntity $employee
     * @return EmployeeEntity
     */
    public function add(EmployeeEntity $employee): EmployeeEntity
    {
        return $this->addEntity($employee);
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\EmployeeRepositoryInterface::update()
     */
    public function update(EmployeeEntity $employee): EmployeeEntity
    {
        return $this->updateEntity($employee);
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\EmployeeRepositoryInterface::remove()
     */
    public function remove(EmployeeEntity $employee): EmployeeEntity
    {
        return $this->removeEntity($employee);
    }
}