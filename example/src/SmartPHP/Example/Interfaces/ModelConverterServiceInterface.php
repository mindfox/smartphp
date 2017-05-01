<?php
namespace SmartPHP\Example\Interfaces;

use SmartPHP\Collections\IteratorStreamInterface;
use SmartPHP\Example\Models\BusinessModels\CompanyBusinessModel;
use SmartPHP\Example\Models\BusinessModels\DepartmentBusinessModel;
use SmartPHP\Example\Models\DataSourceModels\CompanyDataSourceModel;
use SmartPHP\Example\Models\DataSourceModels\DepartmentDataSourceModel;
use SmartPHP\Example\Models\DoctrineEntities\CompanyEntity;
use SmartPHP\Example\Models\DoctrineEntities\DepartmentEntity;
use SmartPHP\Example\Models\BusinessModels\EmployeeBusinessModel;
use SmartPHP\Example\Models\DataSourceModels\EmployeeDataSourceModel;
use SmartPHP\Example\Models\DoctrineEntities\EmployeeEntity;

interface ModelConverterServiceInterface
{

    public function toCompanyDataSourceModel(CompanyBusinessModel $company): CompanyDataSourceModel;

    public function toCompanyDataSourceModels(IteratorStreamInterface $companies): IteratorStreamInterface;

    public function toCompanyEntity(CompanyBusinessModel $company): CompanyEntity;

    public function toCompanyEntities(IteratorStreamInterface $companies): IteratorStreamInterface;

    public function toDepartmentDataSourceModel(DepartmentBusinessModel $department): DepartmentDataSourceModel;

    public function toDepartmentDataSourceModels(IteratorStreamInterface $departments): IteratorStreamInterface;

    public function toDepartmentEntity(DepartmentBusinessModel $department, CompanyEntity $company = null): DepartmentEntity;

    public function toDepartmentEntities(IteratorStreamInterface $departments, CompanyEntity $company = null): IteratorStreamInterface;

    public function toEmployeeDataSourceModel(EmployeeBusinessModel $employee): EmployeeDataSourceModel;
    
    public function toEmployeeDataSourceModels(IteratorStreamInterface $employees): IteratorStreamInterface;
    
    public function toEmployeeEntity(EmployeeBusinessModel $employee): EmployeeEntity;
    
    public function toEmployeeEntities(IteratorStreamInterface $employees): IteratorStreamInterface;
    
    public function fromCompanyDataSourceModel(CompanyDataSourceModel $company): CompanyBusinessModel;

    public function fromCompanyEntity(CompanyEntity $company): CompanyBusinessModel;

    public function fromCompanyEntities(IteratorStreamInterface $companyEntities): IteratorStreamInterface;

    public function fromDepartmentDataSourceModel(DepartmentDataSourceModel $department): DepartmentBusinessModel;
    
    public function fromDepartmentEntity(DepartmentEntity $department, CompanyBusinessModel $company = null): DepartmentBusinessModel;

    public function fromDepartmentEntities(IteratorStreamInterface $departments, CompanyBusinessModel $company = null): IteratorStreamInterface;
    
    public function fromEmployeeDataSourceModel(EmployeeDataSourceModel $employee): EmployeeBusinessModel;
    
    public function fromEmployeeEntity(EmployeeEntity $employee, DepartmentBusinessModel $department = null): EmployeeBusinessModel;
    
    public function fromEmployeeEntities(IteratorStreamInterface $employees, DepartmentBusinessModel $department = null): IteratorStreamInterface;
}
