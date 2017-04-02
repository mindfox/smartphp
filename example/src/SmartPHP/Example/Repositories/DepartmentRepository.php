<?php
namespace SmartPHP\Example\Repositories;

use Doctrine\ORM\EntityRepository;
use SmartPHP\Example\Models\Entities\DepartmentEntity;

class DepartmentRepository extends EntityRepository implements DepartmentRepositoryInterface
{
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\DepartmentRepositoryInterface::fetchAll()
     */
    public function fetchAll(): array
    {
        return $this->findAll();
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\DepartmentRepositoryInterface::fetchOne()
     */
    public function fetchOne(DepartmentEntity $department): DepartmentEntity
    {
        // TODO: Auto-generated method stub
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\DepartmentRepositoryInterface::fetch()
     */
    public function fetch(DepartmentEntity $department = null)
    {
        // TODO: Auto-generated method stub
    }
    
    /**
     *
     * @param DepartmentEntity $department
     * @return DepartmentEntity
     */
    public function add(DepartmentEntity $department): DepartmentEntity
    {
        $this->getEntityManager()->persist($department);
        $this->getEntityManager()->flush();
        return $department;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\DepartmentRepositoryInterface::update()
     */
    public function update(DepartmentEntity $department): DepartmentEntity
    {
        // TODO: Auto-generated method stub
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\DepartmentRepositoryInterface::remove()
     */
    public function remove(DepartmentEntity $department): DepartmentEntity
    {
        // TODO: Auto-generated method stub
    }
}