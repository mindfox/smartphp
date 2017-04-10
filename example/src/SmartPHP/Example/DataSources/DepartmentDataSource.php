<?php
namespace SmartPHP\Example\DataSources;

use SmartPHP\Interfaces\DataSourceInterface;
use SmartPHP\Interfaces\DataSourceOperationInterface;
use SmartPHP\Traits\ModelBinderTrait;
use SmartPHP\Example\Services\DepartmentServiceInterface;
use SmartPHP\Example\Models\Dtos\DepartmentDto;

class DepartmentDataSource implements DataSourceInterface
{
    use ModelBinderTrait;
    
    /**
     *
     * @var DepartmentServiceInterface
     */
    private $departmentService;
    
    public function __construct(DepartmentServiceInterface $departmentService)
    {
        $this->departmentService= $departmentService;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::fetch()
     */
    public function fetch(DataSourceOperationInterface $operation): DataSourceOperationInterface
    {
        $companies = $this->departmentService->fetchAll();
        $operation->setData($companies);
        $operation->setStartRow(0);
        $operation->setEndRow(count($companies)-1);
        $operation->setTotalRows(count($companies));
        return $operation;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::add()
     */
    public function add(DataSourceOperationInterface $operation): DataSourceOperationInterface
    {
        $department = $this->bindOperation($operation, DepartmentDto::class);
        $department = $this->departmentService->add($department);
        $operation->setData($department);
        return $operation;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::update()
     */
    public function update(DataSourceOperationInterface $operation): DataSourceOperationInterface
    {
        $department = $this->bindOperation($operation, DepartmentDto::class);
        $department = $this->departmentService->update($department);
        $operation->setData($department);
        return $operation;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::remove()
     */
    public function remove(DataSourceOperationInterface $operation): DataSourceOperationInterface
    {
        $department = $this->bindOperation($operation, DepartmentDto::class);
        $department = $this->departmentService->remove($department);
        $operation->setData($department);
        return $operation;
    }
}
