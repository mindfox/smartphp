<?php
namespace SmartPHP\Example\Services;

use SmartPHP\Example\Models\DataSourceModels\EmployeeDataSourceModel;

interface EmployeeServiceInterface
{
    
    public function fetchAll(): array;
    
    public function fetchOne(EmployeeDataSourceModel $employee): EmployeeDataSourceModel;
    
    public function fetch(int $startRow, int $endRow): array;
    
    public function add(EmployeeDataSourceModel $employee): EmployeeDataSourceModel;
    
    public function update(EmployeeDataSourceModel $employee): EmployeeDataSourceModel;
    
    public function remove(EmployeeDataSourceModel $employee): EmployeeDataSourceModel;
}
