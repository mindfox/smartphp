<?php
namespace SmartPHP\Example\Models\Converters;

use SmartPHP\Example\Models\DataSourceModels\EmployeeDataSourceModel;
use SmartPHP\Example\Models\DoctrineEntities\EmployeeEntity;

trait EmployeeConverterTrait
{

    public function toEmployeeEntity(EmployeeDataSourceModel $employee): EmployeeEntity
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
        return array_map([
            $this,
            "toEmployeeEntity"
        ], $employees);
    }

    public function toEmployeeDataSourceModel(EmployeeEntity $employee): EmployeeDataSourceModel
    {
        $employeeDataSourceModel = new EmployeeDataSourceModel();
        $employeeDataSourceModel->setId($employee->getId());
        $employeeDataSourceModel->setFirstName($employee->getFirstName());
        $employeeDataSourceModel->setSecondName($employee->getSecondName());
        $employeeDataSourceModel->setSalary($employee->getSalary());
        return $employeeDataSourceModel;
    }

    public function toEmployeeDataSourceModels(array $employees): array
    {
        return array_map([
            $this,
            "toEmployeeDataSourceModel"
        ], $employees);
    }
}
