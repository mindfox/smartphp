<?php
namespace SmartPHP\Example\Repositories\Doctrine;

use SmartPHP\Doctrine\DoctrineDataSourceEntityRepository;
use SmartPHP\Example\Models\DoctrineEntities\EmployeeEntity;
use SmartPHP\Example\Interfaces\Repositories\EmployeeRepositoryInterface;

class DoctrineEmployeeRepository extends DoctrineDataSourceEntityRepository implements EmployeeRepositoryInterface
{
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\EmployeeRepositoryInterface::fetchAll()
     */
    public function fetchAll(): array
    {
        return $this->fetchAllEntities();
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
    public function fetch(int $startRow, int $endRow): array
    {
        return $this->fetch($startRow, $endRow);
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
