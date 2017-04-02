<?php
namespace SmartPHP\Example\Converters;

use SmartPHP\Example\Models\Dtos\EmployeeDto;
use SmartPHP\Example\Models\Entities\EmployeeEntity;

trait EmployeeConverterTrait
{
    public function toEmployeeEntity(EmployeeDto $employee): EmployeeEntity
    {
        $employeeEntity = new EmployeeEntity();
        $employeeEntity->setId($employee->getId());
        $employeeEntity->setFirstName($employee->getFirstName());
        $employeeEntity->setSecondName($employee->getSecondName());
        $employeeEntity->setSalary($employee->getSalary());
        return $employeeEntity;
    }
    
    public function toEmployeeEntities(array $employees): array
    {
        return array_map([$this, "toEmployeeEntity"], $employees);
    }
    
    public function toEmployeeDto(EmployeeEntity $employee): EmployeeDto
    {
        $employeeDto = new EmployeeDto();
        $employeeDto->setId($employee->getId());
        $employeeDto->setFirstName($employee->getFirstName());
        $employeeDto->setSecondName($employee->getSecondName());
        $employeeDto->setSalary($employee->getSalary());
        return $employeeDto;
    }
    
    public function toEmployeeDtos(array $employees): array
    {
        return array_map([$this, "toEmployeeDto"], $employees);
    }
}