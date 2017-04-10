<?php
namespace SmartPHP\Example\Converters;

use SmartPHP\Example\Models\Dtos\CompanyDto;
use SmartPHP\Example\Models\Entities\CompanyEntity;

trait CompanyConverterTrait
{
    public function toCompanyEntity(CompanyDto $dto): CompanyEntity
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
    
    public function toCompanyDto(CompanyEntity $entity): CompanyDto
    {
        $dto = new CompanyDto();
        $dto->setId($entity->getId());
        $dto->setName($entity->getName());
        return $dto;
    }
    
    public function toCompanyDtos(array $entities): array
    {
        return array_map([$this, "toCompanyDto"], $entities);
    }
}
