<?php
namespace SmartPHP\Example\Services;

use SmartPHP\Example\Models\DataSourceModels\DepartmentDataSourceModel;

interface DepartmentServiceInterface
{
    
    public function fetchAll(): array;
    
    public function fetchOne(DepartmentDataSourceModel $department): DepartmentDataSourceModel;
    
    public function fetch(int $startRow, int $endRow): array;
    
    public function add(DepartmentDataSourceModel $department): DepartmentDataSourceModel;
    
    public function update(DepartmentDataSourceModel $department): DepartmentDataSourceModel;
    
    public function remove(DepartmentDataSourceModel $department): DepartmentDataSourceModel;
}
