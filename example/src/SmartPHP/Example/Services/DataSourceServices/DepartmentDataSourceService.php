<?php
namespace SmartPHP\Example\Services\DataSourceServices;

use SmartPHP\Example\Interfaces\BusinessServices\DepartmentBusinessServiceInterface;
use SmartPHP\Example\Interfaces\DataSourceServices\DepartmentDataSourceServiceInterface;
use SmartPHP\Example\Models\DataSourceModels\DepartmentDataSourceModel;
use SmartPHP\Example\Services\BusinessServices\DepartmentBusinessService;
use SmartPHP\Example\Services\ConverterService;

class DepartmentDataSourceService implements DepartmentDataSourceServiceInterface
{
    /**
     *
     * @var DepartmentBusinessServiceInterface
     */
    private $departmentService;
    
    /**
     *
     * @var ConverterService
     */
    private $converter;
    
    public function __construct(DepartmentBusinessService $departmentService, ConverterService $converterService)
    {
        $this->companyService = $departmentService;
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
        return $this->converter->toDepartmentDataSourceModelStream($this->companyService->fetchAll())->toArray();
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
        $department = $this->companyRepository->fetchOne($department);
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
        return $this->converter->toDepartmentDataSourceModelStream($this->companyService->fetch($startRow, $endRow))->toArray();
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
        $department = $this->companyRepository->add($department);
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
        $department = $this->companyRepository->update($department);
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
        $department = $this->companyRepository->remove($department);
        $department = $this->toDepartmentDataSourceModel($department);
        return $department;
    }
}
