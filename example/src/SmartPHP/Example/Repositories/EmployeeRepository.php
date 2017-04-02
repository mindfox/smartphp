<?php
namespace SmartPHP\Example\Repositories;

use Doctrine\ORM\EntityRepository;
use SmartPHP\Example\Models\Entities\EmployeeEntity;

class EmployeeRepository extends EntityRepository implements EmployeeRepositoryInterface
{
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\EmployeeRepositoryInterface::fetchAll()
     */
    public function fetchAll(): array
    {
        return $this->findAll();
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\EmployeeRepositoryInterface::fetchOne()
     */
    public function fetchOne(EmployeeEntity $employee): EmployeeEntity
    {
        // TODO: Auto-generated method stub
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\EmployeeRepositoryInterface::fetch()
     */
    public function fetch(EmployeeEntity $employee = null)
    {
        // TODO: Auto-generated method stub
    }
    
    /**
     *
     * @param EmployeeEntity $employee
     * @return EmployeeEntity
     */
    public function add(EmployeeEntity $employee): EmployeeEntity
    {
        $this->getEntityManager()->persist($employee);
        $this->getEntityManager()->flush();
        return $employee;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\EmployeeRepositoryInterface::update()
     */
    public function update(EmployeeEntity $employee): EmployeeEntity
    {
        // TODO: Auto-generated method stub
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\EmployeeRepositoryInterface::remove()
     */
    public function remove(EmployeeEntity $employee): EmployeeEntity
    {
        // TODO: Auto-generated method stub
    }
}