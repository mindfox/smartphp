<?php
namespace SmartPHP\Example\Interfaces\ConverterServices;

use SmartPHP\Example\Models\DataSourceModels\EmployeeDataSourceModel;
use Smartphp\example\models\BusinessModels\EmployeeBusinessModel;
use SmartPHP\Example\Models\DoctrineEntities\EmployeeEntity;

interface EmployeeConverterServiceInterface
{

    public function convertDataSourceModelToBusinessModel(EmployeeDataSourceModel $company): EmployeeBusinessModel;

    public function convertBusinessModelToDataSourceModel(EmployeeBusinessModel $company): EmployeeDataSourceModel;

    public function convertBusinessModelToEntity(EmployeeBusinessModel $company): EmployeeEntity;

    public function convertEntityToBusinessModel(EmployeeEntity $company): EmployeeBusinessModel;
}
