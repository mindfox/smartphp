<?php
namespace SmartPHP\Example\Services;

use SmartPHP\Example\Interfaces\Repositories\EmployeeRepositoryInterface;
use SmartPHP\Example\Models\DataSourceModels\EmployeeDataSourceModel;
use SmartPHP\Example\Models\Converters\EmployeeConverterTrait;
use SmartPHP\Example\Interfaces\DataSourceServices\EmployeeDataSourceServiceInterface;

class EmployeeDataSourceService implements EmployeeDataSourceServiceInterface
{
    
    use EmployeeConverterTrait;

    /**
     *
     * @var EmployeeRepositoryInterface
     */
    private $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\EmployeeServiceInterface::fetchAll()
     */
    public function fetchAll(): array
    {
        $entities = $this->employeeRepository->fetchAll();
        return $this->toEmployeeDataSourceModels($entities);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\EmployeeServiceInterface::fetchOne()
     */
    public function fetchOne(EmployeeDataSourceModel $employee): EmployeeDataSourceModel
    {
        $employee = $this->toEmployeeEntity($employee);
        $employee = $this->employeeRepository->fetchOne($employee);
        $employee = $this->toEmployeeDataSourceModel($employee);
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
        return $this->fetchAll();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\EmployeeServiceInterface::add()
     */
    public function add(EmployeeDataSourceModel $employee): EmployeeDataSourceModel
    {
        $employee = $this->toEmployeeEntity($employee);
        $employee = $this->employeeRepository->add($employee);
        $employee = $this->toEmployeeDataSourceModel($employee);
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
        $employee = $this->toEmployeeEntity($employee);
        $employee = $this->employeeRepository->update($employee);
        $employee = $this->toEmployeeDataSourceModel($employee);
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
        $employee = $this->toEmployeeEntity($employee);
        $employee = $this->employeeRepository->remove($employee);
        $employee = $this->toEmployeeDataSourceModel($employee);
        return $employee;
    }
}