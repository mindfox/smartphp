<?php
namespace SmartPHP\Example\Services\DataSourceServices;

use SmartPHP\Example\Interfaces\BusinessServices\EmployeeBusinessServiceInterface;
use SmartPHP\Example\Interfaces\DataSourceServices\EmployeeDataSourceServiceInterface;
use SmartPHP\Example\Interfaces\ModelConverterServiceInterface;
use SmartPHP\Example\Models\DataSourceModels\EmployeeDataSourceModel;

class EmployeeDataSourceService implements EmployeeDataSourceServiceInterface
{
    /**
     *
     * @var EmployeeBusinessServiceInterface
     */
    private $employeeService;
    
    /**
     *
     * @var ModelConverterServiceInterface
     */
    private $converter;
    
    public function __construct(EmployeeBusinessServiceInterface $employeeService, ModelConverterServiceInterface $converterService)
    {
        $this->employeeService = $employeeService;
        $this->converter = $converterService;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\EmployeeServiceInterface::fetchAll()
     */
    public function fetchAll(): array
    {
        return $this->converter->toEmployeeDataSourceModels($this->employeeService->fetchAll())->toArray();
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\EmployeeServiceInterface::fetchOne()
     */
    public function fetchOne(EmployeeDataSourceModel $employee): EmployeeDataSourceModel
    {
        $employee = $this->converter->fromEmployeeDataSourceModel($employee);
        $employee = $this->employeeService->fetchOne($employee);
        $employee = $this->converter->toEmployeeDataSourceModel($employee);
        return $employee;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\EmployeeServiceInterface::fetch()
     */
    public function fetch(int $startRow, int $endRow): array
    {
        return $this->converter->toEmployeeDataSourceModels($this->employeeService->fetch($startRow, $endRow))->toArray();
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\EmployeeServiceInterface::add()
     */
    public function add(EmployeeDataSourceModel $employee): EmployeeDataSourceModel
    {
        $employee = $this->converter->fromEmployeeDataSourceModel($employee);
        $employee = $this->employeeService->add($employee);
        $employee = $this->converter->toEmployeeDataSourceModel($employee);
        return $employee;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\EmployeeServiceInterface::update()
     */
    public function update(EmployeeDataSourceModel $employee): EmployeeDataSourceModel
    {
        $employee = $this->converter->fromEmployeeDataSourceModel($employee);
        $employee = $this->employeeService->update($employee);
        $employee = $this->converter->toEmployeeDataSourceModel($employee);
        return $employee;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\EmployeeServiceInterface::remove()
     */
    public function remove(EmployeeDataSourceModel $employee): EmployeeDataSourceModel
    {
        $employee = $this->converter->fromEmployeeDataSourceModel($employee);
        $employee = $this->employeeService->remove($employee);
        $employee = $this->converter->toEmployeeDataSourceModel($employee);
        return $employee;
    }
}
