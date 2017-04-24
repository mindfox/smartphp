<?php
namespace SmartPHP\Example\Services\DataSourceServices;

use SmartPHP\Example\Interfaces\BusinessServices\DepartmentBusinessServiceInterface;
use SmartPHP\Example\Interfaces\DataSourceServices\DepartmentDataSourceServiceInterface;
use SmartPHP\Example\Interfaces\ModelConverterServiceInterface;
use SmartPHP\Example\Models\DataSourceModels\DepartmentDataSourceModel;

class DepartmentDataSourceService implements DepartmentDataSourceServiceInterface
{
    /**
     *
     * @var DepartmentBusinessServiceInterface
     */
    private $departmentService;
    
    /**
     *
     * @var ModelConverterServiceInterface
     */
    private $converter;
    
    public function __construct(DepartmentBusinessServiceInterface $departmentService, ModelConverterServiceInterface $converterService)
    {
        $this->departmentService = $departmentService;
        $this->converter = $converterService;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\DepartmentServiceInterface::fetchAll()
     */
    public function fetchAll(): array
    {
        return $this->converter->toDepartmentDataSourceModels($this->departmentService->fetchAll())->toArray();
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\DepartmentServiceInterface::fetchOne()
     */
    public function fetchOne(DepartmentDataSourceModel $department): DepartmentDataSourceModel
    {
        $department = $this->converter->fromDepartmentDataSourceModel($department);
        $department = $this->departmentService->fetchOne($department);
        $department = $this->converter->toDepartmentDataSourceModel($department);
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
        return $this->converter->toDepartmentDataSourceModels($this->departmentService->fetch($startRow, $endRow))->toArray();
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\DepartmentServiceInterface::add()
     */
    public function add(DepartmentDataSourceModel $department): DepartmentDataSourceModel
    {
        $department = $this->converter->fromDepartmentDataSourceModel($department);
        $department = $this->departmentService->add($department);
        $department = $this->converter->toDepartmentDataSourceModel($department);
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
        $department = $this->converter->fromDepartmentDataSourceModel($department);
        $department = $this->departmentService->update($department);
        $department = $this->converter->toDepartmentDataSourceModel($department);
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
        $department = $this->converter->fromDepartmentDataSourceModel($department);
        $department = $this->departmentService->remove($department);
        $department = $this->converter->toDepartmentDataSourceModel($department);
        return $department;
    }
}
