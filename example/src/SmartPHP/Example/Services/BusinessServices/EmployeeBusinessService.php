<?php
namespace SmartPHP\Example\Services\BusinessServices;

use SmartPHP\Collections\IteratorStreamInterface;
use SmartPHP\Example\Interfaces\BusinessServices\EmployeeBusinessServiceInterface;
use SmartPHP\Example\Interfaces\Repositories\EmployeeRepositoryInterface;
use SmartPHP\Example\Models\BusinessModels\EmployeeBusinessModel;
use SmartPHP\Example\Services\ConverterService;

class EmployeeBusinessService implements EmployeeBusinessServiceInterface
{

    private $employeeRepository;

    /**
     *
     * @var ConverterService
     */
    private $converter;

    public function __construct(EmployeeRepositoryInterface $employeeRepository, ConverterService $converter)
    {
        $this->companyRepository = $employeeRepository;
        $this->converter = $converter;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\BusinessServices\EmployeeBusinessServiceInterface::fetchAll()
     */
    public function fetchAll(): IteratorStreamInterface
    {
        return $this->converter->fromEmployeeEntityStream($this->companyRepository->fetchAll());
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\BusinessServices\EmployeeBusinessServiceInterface::fetchOne()
     */
    public function fetchOne(EmployeeBusinessModel $employee): EmployeeBusinessModel
    {
        // TODO: Auto-generated method stub
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\BusinessServices\EmployeeBusinessServiceInterface::fetch()
     */
    public function fetch(int $startRow, int $endRow): IteratorStreamInterface
    {
        return $this->converter->fromEmployeeEntityStream($this->companyRepository->fetch($startRow, $endRow));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\BusinessServices\EmployeeBusinessServiceInterface::add()
     */
    public function add(EmployeeBusinessModel $employee): EmployeeBusinessModel
    {
        $employee = $this->converter->toEmployeeEntity($employee);
        $employee = $this->companyRepository->add($employee);
        $employee = $this->converter->fromEmployeeEntity($employee);
        return $employee;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\BusinessServices\EmployeeBusinessServiceInterface::update()
     */
    public function update(EmployeeBusinessModel $employee): EmployeeBusinessModel
    {
        $employee = $this->converter->toEmployeeEntity($employee);
        $employee = $this->companyRepository->update($employee);
        $employee = $this->converter->fromEmployeeEntity($employee);
        return $employee;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\BusinessServices\EmployeeBusinessServiceInterface::remove()
     */
    public function remove(EmployeeBusinessModel $employee): EmployeeBusinessModel
    {
        $employee = $this->converter->toEmployeeEntity($employee);
        $employee = $this->companyRepository->remove($employee);
        $employee = $this->converter->fromEmployeeEntity($employee);
        return $employee;
    }
}