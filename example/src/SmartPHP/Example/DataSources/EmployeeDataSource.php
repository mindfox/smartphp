<?php
namespace SmartPHP\Example\DataSources;

use SmartPHP\Interfaces\DataSourceInterface;
use SmartPHP\Interfaces\DSOperationInterface;
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
    public function fetch(DSOperationInterface $operation): DSOperationInterface
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
    public function add(DSOperationInterface $operation): DSOperationInterface
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
    public function update(DSOperationInterface $operation): DSOperationInterface
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
    public function remove(DSOperationInterface $operation): DSOperationInterface
    {
        $employee = $this->bindOperation($operation, EmployeeDto::class);
        $employee = $this->employeeService->remove($employee);
        $operation->setData($employee);
        return $operation;
    }
}
