<?php
namespace SmartPHP\Example\Services;

use SmartPHP\Example\Repositories\EmployeeRepositoryInterface;
use SmartPHP\Example\Models\Dtos\EmployeeDto;
use SmartPHP\Example\Converters\EmployeeConverterTrait;

class EmployeeService implements EmployeeServiceInterface
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
        return $this->toEmployeeDtos($entities);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\EmployeeServiceInterface::fetchOne()
     */
    public function fetchOne(EmployeeDto $employee): EmployeeDto
    {
        $employee = $this->toEmployeeEntity($employee);
        $employee = $this->employeeRepository->fetchOne($employee);
        $employee = $this->toEmployeeDto($employee);
        return $employee;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\EmployeeServiceInterface::fetch()
     */
    public function fetch(EmployeeDto $employee = null)
    {
        if (is_null($employee)) {
            $employee = $this->employeeRepository->fetch();
        } else {
            $employee = $this->toEmployeeEntity($employee);
            $employee = $this->employeeRepository->fetch($employee);
        }
        $employee = $this->toEmployeeDto($employee);
        return $employee;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\EmployeeServiceInterface::add()
     */
    public function add(EmployeeDto $employee): EmployeeDto
    {
        $employee = $this->toEmployeeEntity($employee);
        $employee = $this->employeeRepository->add($employee);
        $employee = $this->toEmployeeDto($employee);
        return $employee;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\EmployeeServiceInterface::update()
     */
    public function update(EmployeeDto $employee): EmployeeDto
    {
        $employee = $this->toEmployeeEntity($employee);
        $employee = $this->employeeRepository->update($employee);
        $employee = $this->toEmployeeDto($employee);
        return $employee;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\EmployeeServiceInterface::remove()
     */
    public function remove(EmployeeDto $employee): EmployeeDto
    {
        $employee = $this->toEmployeeEntity($employee);
        $employee = $this->employeeRepository->remove($employee);
        $employee = $this->toEmployeeDto($employee);
        return $employee;
    }
}