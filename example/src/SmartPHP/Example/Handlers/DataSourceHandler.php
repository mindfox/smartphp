<?php
namespace SmartPHP\Example\Handlers;

use SmartPHP\Example\Models\DataSourceModels\CompanyDataSourceModel;
use SmartPHP\Example\Models\DataSourceModels\DepartmentDataSourceModel;
use SmartPHP\Example\Models\DataSourceModels\EmployeeDataSourceModel;
use SmartPHP\Example\Services\CompanyServiceInterface;
use SmartPHP\Example\Services\DepartmentServiceInterface;
use SmartPHP\Example\Services\EmployeeServiceInterface;
use SmartPHP\Interfaces\DataSourceFactoryInterface;
use SmartPHP\Slim\SlimDataSourceHandler;

class DataSourceHandler extends SlimDataSourceHandler
{

    protected function configureDataSources(DataSourceFactoryInterface $dataSourceFactory)
    {
        $dataSourceFactory->register("CompanyDataSource", CompanyServiceInterface::class, CompanyDataSourceModel::class);
        $dataSourceFactory->register("DepartmentDataSource", DepartmentServiceInterface::class, DepartmentDataSourceModel::class);
        $dataSourceFactory->register("EmployeeDataSource", EmployeeServiceInterface::class, EmployeeDataSourceModel::class);
    }
}

