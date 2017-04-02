<?php
namespace SmartPHP\Example\Converters;

use SmartPHP\Example\Models\Dtos\DepartmentDto;

trait DepartmentConverterTrait
{
    public function toDepartmentEntity(DepartmentDto $department)
    {
        
    }
    
    public function toDepartmentEntities(array $departments): array
    {
        return array_map([$this, "toDepartmentEntity"], $departments);
    }
    
    public function toDepartmentDto()
    {
        
    }
    
    public function toDepartmentDtos(array $departments): array
    {
        return array_map([$this, "toDepartmentDto"], $departments);
    }
}