<?php
namespace SmartPHP\Example\Services;

use SmartPHP\Example\Models\Dtos\DepartmentDto;

interface DepartmentServiceInterface
{
    
    public function fetchAll(): array;
    
    public function fetchOne(DepartmentDto $company): DepartmentDto;
    
    public function fetch(DepartmentDto $company = null);
    
    public function add(DepartmentDto $company): DepartmentDto;
    
    public function update(DepartmentDto $company): DepartmentDto;
    
    public function remove(DepartmentDto $company): DepartmentDto;
}