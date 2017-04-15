<?php
namespace SmartPHP\Example\DataSources;

use SmartPHP\Example\Models\Dtos\EmployeeDto;
use SmartPHP\Example\Services\EmployeeServiceInterface;
use SmartPHP\Interfaces\DataSourceInterface;
use SmartPHP\Traits\ModelBinderTrait;

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
    public function fetch(int $startRow, int $endRow): array
    {
        return $this->employeeService->fetchAll();
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::add()
     */
    public function add(array $data): array
    {
        $employee = $this->bind($data, EmployeeDto::class);
        $employee = $this->employeeService->add($employee);
        return $this->unbind($employee);
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::update()
     */
    public function update(array $data, array $oldValues): array
    {
        $employee = $this->bindMerged($data, $oldValues, EmployeeDto::class);
        $employee = $this->employeeService->update($employee);
        return $this->unbind($employee);
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::remove()
     */
    public function remove(array $data): array
    {
        $employee = $this->bind($data, EmployeeDto::class);
        $employee = $this->employeeService->remove($employee);
        return $this->unbind($employee);
    }
}
