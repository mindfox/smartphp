<?php
namespace SmartPHP\Example\Services;

use SmartPHP\Example\Repositories\DepartmentRepositoryInterface;
use SmartPHP\Example\Models\DataSourceModels\DepartmentDataSourceModel;
use SmartPHP\Example\Models\Converters\DepartmentConverterTrait;

class DepartmentService implements DepartmentServiceInterface
{
    
    use DepartmentConverterTrait;

    /**
     *
     * @var DepartmentRepositoryInterface
     */
    private $departmentRepository;

    public function __construct(DepartmentRepositoryInterface $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\DepartmentServiceInterface::fetchAll()
     */
    public function fetchAll(): array
    {
        $entities = $this->departmentRepository->fetchAll();
        return $this->toDepartmentDataSourceModels($entities);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\DepartmentServiceInterface::fetchOne()
     */
    public function fetchOne(DepartmentDataSourceModel $department): DepartmentDataSourceModel
    {
        $department = $this->toDepartmentEntity($department);
        $department = $this->departmentRepository->fetchOne($department);
        $department = $this->toDepartmentDataSourceModel($department);
        return $department;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\DepartmentServiceInterface::fetch()
     */
    public function fetch(int $startRow, int $endRow): array
    {
        return $this->fetchAll();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\DepartmentServiceInterface::add()
     */
    public function add(DepartmentDataSourceModel $department): DepartmentDataSourceModel
    {
        $department = $this->toDepartmentEntity($department);
        $department = $this->departmentRepository->add($department);
        $department = $this->toDepartmentDataSourceModel($department);
        return $department;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\DepartmentServiceInterface::update()
     */
    public function update(DepartmentDataSourceModel $department): DepartmentDataSourceModel
    {
        $department = $this->toDepartmentEntity($department);
        $department = $this->departmentRepository->update($department);
        $department = $this->toDepartmentDataSourceModel($department);
        return $department;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\DepartmentServiceInterface::remove()
     */
    public function remove(DepartmentDataSourceModel $department): DepartmentDataSourceModel
    {
        $department = $this->toDepartmentEntity($department);
        $department = $this->departmentRepository->remove($department);
        $department = $this->toDepartmentDataSourceModel($department);
        return $department;
    }
}
