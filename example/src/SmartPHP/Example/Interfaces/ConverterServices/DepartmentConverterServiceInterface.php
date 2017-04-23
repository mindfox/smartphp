<?php
namespace SmartPHP\Example\Interfaces\ConverterServices;

use SmartPHP\Example\Models\DataSourceModels\DepartmentDataSourceModel;
use Smartphp\example\models\BusinessModels\DepartmentBusinessModel;
use SmartPHP\Example\Models\DoctrineEntities\DepartmentEntity;

interface DepartmentConverterServiceInterface
{

    public function convertDataSourceModelToBusinessModel(DepartmentDataSourceModel $department): DepartmentBusinessModel;

    public function convertBusinessModelToDataSourceModel(DepartmentBusinessModel $department): DepartmentDataSourceModel;

    public function convertBusinessModelToEntity(DepartmentBusinessModel $department): DepartmentEntity;

    public function convertEntityToBusinessModel(DepartmentEntity $department): DepartmentBusinessModel;
}
