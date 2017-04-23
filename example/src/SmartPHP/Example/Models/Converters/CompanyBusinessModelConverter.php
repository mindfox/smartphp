<?php
namespace SmartPHP\Example\Models\Converters;

use Smartphp\example\models\BusinessModels\CompanyBusinessModel;
use SmartPHP\Example\Models\DataSourceModels\CompanyDataSourceModel;
use SmartPHP\Example\Models\DoctrineEntities\CompanyEntity;

class CompanyBusinesModelConverter
{
        
    public function toDataSourceModel(CompanyBusinessModel $company): CompanyDataSourceModel
    {
        $dsm = new CompanyDataSourceModel();
        $dsm->setId($company->getId());
        $dsm->setName($company->getName());
        return $dsm;
    }
    
    public function toEntity(CompanyBusinessModel $company): CompanyEntity
    {
        $entity = new CompanyEntity();
        $entity->setId($company->getId());
        $entity->setName($company->getName());
        return $entity;
    }
    
    public function fromDataSourceModel(CompanyDataSourceModel$company): CompanyBusinessModel
    {
        $bm = new CompanyBusinessModel();
        $bm->setId($company->getId());
        $bm->setName($company->getName());
        return $bm;
    }
}
