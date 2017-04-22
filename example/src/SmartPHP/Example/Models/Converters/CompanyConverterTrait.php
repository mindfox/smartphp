<?php
namespace SmartPHP\Example\Models\Converters;

use SmartPHP\Example\Models\DataSourceModels\CompanyDataSourceModel;
use SmartPHP\Example\Models\DoctrineEntities\CompanyEntity;

trait CompanyConverterTrait
{
    public function toCompanyEntity(CompanyDataSourceModel $dto): CompanyEntity
    {
        $entity = new CompanyEntity();
        $entity->setId($dto->getId());
        $entity->setName($dto->getName());
        return $entity;
    }
    
    public function toCompanyEntities(array $dtos): array
    {
        return array_map([$this, "toCompanyEntity"], $dtos);
    }
    
    public function toCompanyDataSourceModel(CompanyEntity $entity): CompanyDataSourceModel
    {
        $dto = new CompanyDataSourceModel();
        $dto->setId($entity->getId());
        $dto->setName($entity->getName());
        return $dto;
    }
    
    public function toCompanyDataSourceModels(array $entities): array
    {
        return array_map([$this, "toCompanyDataSourceModel"], $entities);
    }
}
