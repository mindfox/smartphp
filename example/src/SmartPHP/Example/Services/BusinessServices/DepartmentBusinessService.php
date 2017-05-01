<?php
namespace SmartPHP\Example\Services\BusinessServices;

use Sabertooth\IteratorStreams\IteratorStreamInterface;
use SmartPHP\Example\Interfaces\BusinessServices\DepartmentBusinessServiceInterface;
use SmartPHP\Example\Interfaces\ModelConverterServiceInterface;
use SmartPHP\Example\Interfaces\Repositories\DepartmentRepositoryInterface;
use SmartPHP\Example\Models\BusinessModels\DepartmentBusinessModel;

class DepartmentBusinessService implements DepartmentBusinessServiceInterface
{

    private $departmentRepository;

    /**
     *
     * @var ModelConverterServiceInterface
     */
    private $converter;

    public function __construct(DepartmentRepositoryInterface $departmentRepository, ModelConverterServiceInterface $converter)
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
        return $this->converter->fromDepartmentEntities($this->departmentRepository->fetchAll());
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
        return $this->converter->fromDepartmentEntities($this->departmentRepository->fetch($startRow, $endRow));
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
