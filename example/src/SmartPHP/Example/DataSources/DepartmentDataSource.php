<?php
namespace SmartPHP\Example\DataSources;

use SmartPHP\Example\Models\Dtos\DepartmentDto;
use SmartPHP\Example\Services\DepartmentServiceInterface;
use SmartPHP\Interfaces\DataSourceInterface;
use SmartPHP\Traits\ModelBinderTrait;

class DepartmentDataSource implements DataSourceInterface
{
    use ModelBinderTrait;
    
    /**
     *
     * @var DepartmentServiceInterface
     */
    private $departmentService;
    
    public function __construct(DepartmentServiceInterface $departmentService)
    {
        $this->departmentService= $departmentService;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::fetch()
     */
    public function fetch(int $startRow, int $endRow): array
    {
        return $this->departmentService->fetchAll();
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::add()
     */
    public function add(array $data): array
    {
        $department = $this->bind($data, DepartmentDto::class);
        $department = $this->departmentService->add($department);
        return $this->unbind($department);
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::update()
     */
    public function update(array $data, array $oldValues): array
    {
        $department = $this->bindMerged($data, $oldValues, DepartmentDto::class);
        $department = $this->departmentService->update($department);
        return $this->unbind($department);
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::remove()
     */
    public function remove(array $data): array
    {
        $department = $this->bind($data, DepartmentDto::class);
        $department = $this->departmentService->remove($department);
        return $this->unbind($department);
    }
}
