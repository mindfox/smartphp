<?php
namespace SmartPHP\Example\DataSources;

use SmartPHP\Interfaces\DataSourceInterface;
use SmartPHP\Interfaces\DataSourceOperationInterface;
use SmartPHP\Traits\ModelBinderTrait;
use SmartPHP\Example\Services\EmployeeServiceInterface;
use SmartPHP\Example\Models\Dtos\EmployeeDto;

class EmployeeDataSource implements DataSourceInterface
{
    use ModelBinderTrait;
    
    /**
     *
     * @var EmployeeServiceInterface
     */
    private $employeeService;
    
    public function __construct(EmployeeServiceInterface $employeeService)
    {
        $this->employeeService= $employeeService;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::fetch()
     */
    public function fetch(DataSourceOperationInterface $operation): DataSourceOperationInterface
    {
        $companies = $this->employeeService->fetchAll();
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
        $employee = $this->bindOperation($operation, EmployeeDto::class);
        $employee = $this->employeeService->add($employee);
        $operation->setData($employee);
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
        $employee = $this->bindOperation($operation, EmployeeDto::class);
        $employee = $this->employeeService->update($employee);
        $operation->setData($employee);
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
        $employee = $this->bindOperation($operation, EmployeeDto::class);
        $employee = $this->employeeService->remove($employee);
        $operation->setData($employee);
        return $operation;
    }
}
