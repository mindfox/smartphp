<?php
namespace SmartPHP\Example\DataSources;

use SmartPHP\Interfaces\DataSourceInterface;
use SmartPHP\Interfaces\DataSourceMessageInterface;
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
    public function fetch(DataSourceMessageInterface $message): DataSourceMessageInterface
    {
        $companies = $this->departmentService->fetchAll();
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
    public function add(DataSourceMessageInterface $message): DataSourceMessageInterface
    {
        $department = $this->bind($message->getData(), DepartmentDto::class);
        $department = $this->departmentService->add($department);
        $message->setData($department);
        return $message;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::update()
     */
    public function update(DataSourceMessageInterface $message): DataSourceMessageInterface
    {
        return $message;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::remove()
     */
    public function remove(DataSourceMessageInterface $message): DataSourceMessageInterface
    {
        return $message;
    }
}