<?php
namespace SmartPHP\Example\Interfaces\DataSourceServices;

use SmartPHP\Example\Models\DataSourceModels\DepartmentDataSourceModel;

interface DepartmentDataSourceServiceInterface
{
    
    public function fetchAll(): array;
    
    public function fetchOne(DepartmentDataSourceModel $department): DepartmentDataSourceModel;
    
    public function fetch(int $startRow, int $endRow): array;
    
    public function add(DepartmentDataSourceModel $department): DepartmentDataSourceModel;
    
    public function update(DepartmentDataSourceModel $department): DepartmentDataSourceModel;
    
    public function remove(DepartmentDataSourceModel $department): DepartmentDataSourceModel;
}
