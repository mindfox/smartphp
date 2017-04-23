<?php
namespace SmartPHP\Example\Interfaces\ConverterServices;

use SmartPHP\Example\Models\DataSourceModels\CompanyDataSourceModel;
use Smartphp\example\models\BusinessModels\CompanyBusinessModel;
use SmartPHP\Example\Models\DoctrineEntities\CompanyEntity;

interface CompanyConverterServiceInterface
{

    public function convertDataSourceModelToBusinessModel(CompanyDataSourceModel $company): CompanyBusinessModel;
    
    public function convertBusinessModelToDataSourceModel(CompanyBusinessModel $company): CompanyDataSourceModel;

    public function convertBusinessModelToEntity(CompanyBusinessModel $company): CompanyEntity;
    
    public function convertEntityToBusinessModel(CompanyEntity $company): CompanyBusinessModel;
}
