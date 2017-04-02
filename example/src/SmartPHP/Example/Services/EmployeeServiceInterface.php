<?php
namespace SmartPHP\Example\Services;

use SmartPHP\Example\Models\Dtos\EmployeeDto;

interface EmployeeServiceInterface
{
    
    public function fetchAll(): array;
    
    public function fetchOne(EmployeeDto $company): EmployeeDto;
    
    public function fetch(EmployeeDto $company = null);
    
    public function add(EmployeeDto $company): EmployeeDto;
    
    public function update(EmployeeDto $company): EmployeeDto;
    
    public function remove(EmployeeDto $company): EmployeeDto;
}