<?php
namespace SmartPHP\Example\Services;

use SmartPHP\Example\Models\Dtos\DepartmentDto;

interface DepartmentServiceInterface
{
    
    public function fetchAll(): array;
    
    public function fetchOne(DepartmentDto $department): DepartmentDto;
    
    public function fetch(int $startRow, int $endRow): array;
    
    public function add(DepartmentDto $department): DepartmentDto;
    
    public function update(DepartmentDto $department): DepartmentDto;
    
    public function remove(DepartmentDto $department): DepartmentDto;
}
