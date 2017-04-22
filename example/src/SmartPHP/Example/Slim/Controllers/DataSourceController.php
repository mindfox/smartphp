<?php
namespace SmartPHP\Example\Slim\Controllers;

use SmartPHP\Example\Interfaces\DataSourceServices\CompanyDataSourceServiceInterface;
use SmartPHP\Example\Interfaces\DataSourceServices\DepartmentDataSourceServiceInterface;
use SmartPHP\Example\Interfaces\DataSourceServices\EmployeeDataSourceServiceInterface;
use SmartPHP\Example\Models\DataSourceModels\CompanyDataSourceModel;
use SmartPHP\Example\Models\DataSourceModels\DepartmentDataSourceModel;
use SmartPHP\Example\Models\DataSourceModels\EmployeeDataSourceModel;
use SmartPHP\Interfaces\DataSourceFactoryInterface;
use SmartPHP\Slim\SlimDataSourceController;

class DataSourceController extends SlimDataSourceController
{
    protected function configureDataSources(DataSourceFactoryInterface $dataSourceFactory)
    {
        $dataSourceFactory->register("CompanyDataSource", CompanyDataSourceServiceInterface::class, CompanyDataSourceModel::class);
        $dataSourceFactory->register("DepartmentDataSource", DepartmentDataSourceServiceInterface::class, DepartmentDataSourceModel::class);
        $dataSourceFactory->register("EmployeeDataSource", EmployeeDataSourceServiceInterface::class, EmployeeDataSourceModel::class);
    }
}
