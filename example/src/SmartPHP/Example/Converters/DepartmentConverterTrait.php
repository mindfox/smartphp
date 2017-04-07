<?php
namespace SmartPHP\Example\Converters;

use SmartPHP\Example\Models\Dtos\DepartmentDto;
use SmartPHP\Example\Models\Entities\DepartmentEntity;
use SmartPHP\Example\Models\Entities\CompanyEntity;

trait DepartmentConverterTrait
{
    public function toDepartmentEntity(DepartmentDto $department)
    {
        $entity = new DepartmentEntity();
        $entity->setId($department->getId());
        $entity->setName($department->getName());
        $entity->setCompany((new CompanyEntity())->setId($department->getCompanyId()));
        return $entity;
    }
    
    public function toDepartmentEntities(array $departments): array
    {
        return array_map([$this, "toDepartmentEntity"], $departments);
    }
    
    public function toDepartmentDto(DepartmentEntity $department)
    {
        $dto = new DepartmentDto();
        $dto->setId($department->getId());
        $dto->setName($department->getName());
        $dto->setCompanyId($department->getCompany()->getId());
        return $dto;
    }
    
    public function toDepartmentDtos(array $departments): array
    {
        return array_map([$this, "toDepartmentDto"], $departments);
    }
}