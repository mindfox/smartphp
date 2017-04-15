<?php
namespace SmartPHP\Example\Services;

use SmartPHP\Example\Models\Dtos\EmployeeDto;

interface EmployeeServiceInterface
{
    
    public function fetchAll(): array;
    
    public function fetchOne(EmployeeDto $employee): EmployeeDto;
    
    public function fetch(int $startRow, int $endRow): array;
    
    public function add(EmployeeDto $employee): EmployeeDto;
    
    public function update(EmployeeDto $employee): EmployeeDto;
    
    public function remove(EmployeeDto $employee): EmployeeDto;
}
