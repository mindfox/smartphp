<?php
namespace SmartPHP\Example\Services\BusinessServices;

use SmartPHP\Collections\IteratorStreamInterface;
use SmartPHP\Example\Interfaces\BusinessServices\DepartmentBusinessServiceInterface;
use SmartPHP\Example\Interfaces\Repositories\DepartmentRepositoryInterface;
use SmartPHP\Example\Models\BusinessModels\DepartmentBusinessModel;
use SmartPHP\Example\Services\ConverterService;

class DepartmentBusinessService implements DepartmentBusinessServiceInterface
{

    private $departmentRepository;

    /**
     *
     * @var ConverterService
     */
    private $converter;

    public function __construct(DepartmentRepositoryInterface $departmentRepository, ConverterService $converter)
    {
        $this->departmentRepository = $departmentRepository;
        $this->converter = $converter;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\BusinessServices\DepartmentBusinessServiceInterface::fetchAll()
     */
    public function fetchAll(): IteratorStreamInterface
    {
        return $this->converter->fromDepartmentEntityStream($this->departmentRepository->fetchAll());
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\BusinessServices\DepartmentBusinessServiceInterface::fetchOne()
     */
    public function fetchOne(DepartmentBusinessModel $department): DepartmentBusinessModel
    {
        // TODO: Auto-generated method stub
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\BusinessServices\DepartmentBusinessServiceInterface::fetch()
     */
    public function fetch(int $startRow, int $endRow): IteratorStreamInterface
    {
        return $this->converter->fromDepartmentEntityStream($this->departmentRepository->fetch($startRow, $endRow));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\BusinessServices\DepartmentBusinessServiceInterface::add()
     */
    public function add(DepartmentBusinessModel $department): DepartmentBusinessModel
    {
        $department = $this->converter->toDepartmentEntity($department);
        $department = $this->departmentRepository->add($department);
        $department = $this->converter->fromDepartmentEntity($department);
        return $department;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\BusinessServices\DepartmentBusinessServiceInterface::update()
     */
    public function update(DepartmentBusinessModel $department): DepartmentBusinessModel
    {
        $department = $this->converter->toDepartmentEntity($department);
        $department = $this->departmentRepository->update($department);
        $department = $this->converter->fromDepartmentEntity($department);
        return $department;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\BusinessServices\DepartmentBusinessServiceInterface::remove()
     */
    public function remove(DepartmentBusinessModel $department): DepartmentBusinessModel
    {
        $department = $this->converter->toDepartmentEntity($department);
        $department = $this->departmentRepository->remove($department);
        $department = $this->converter->fromDepartmentEntity($department);
        return $department;
    }
}
