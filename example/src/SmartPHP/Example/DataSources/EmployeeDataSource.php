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
    public function fetch(DataSourceOperationInterface $message): DataSourceMessageInterface
    {
        $companies = $this->employeeService->fetchAll();
        $message->setData($companies);
        $message->setStartRow(0);
        $message->setEndRow(count($companies)-1);
        $message->setTotalRows(count($companies));
        return $message;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::add()
     */
    public function add(DataSourceOperationInterface $message): DataSourceMessageInterface
    {
        $employee = $this->bind($message->getData(), EmployeeDto::class);
        $employee = $this->employeeService->add($employee);
        $message->setData($employee);
        return $message;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::update()
     */
    public function update(DataSourceOperationInterface $message): DataSourceMessageInterface
    {
        return $message;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::remove()
     */
    public function remove(DataSourceOperationInterface $message): DataSourceMessageInterface
    {
        return $message;
    }
}