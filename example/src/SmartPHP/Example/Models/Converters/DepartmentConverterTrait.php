<?php
namespace SmartPHP\Example\Models\Converters;

use SmartPHP\Example\Models\DataSourceModels\DepartmentDataSourceModel;
use SmartPHP\Example\Models\Entities\DepartmentEntity;
use SmartPHP\Example\Models\Entities\CompanyEntity;

trait DepartmentConverterTrait
{

    public function toDepartmentEntity(DepartmentDataSourceModel $department)
    {
        $entity = new DepartmentEntity();
        $entity->setId($department->getId());
        $entity->setName($department->getName());
        $entity->setCompany((new CompanyEntity())->setId($department->getCompanyId()));
        return $entity;
    }

    public function toDepartmentEntities(array $departments): array
    {
        return array_map([
            $this,
            "toDepartmentEntity"
        ], $departments);
    }

    public function toDepartmentDataSourceModel(DepartmentEntity $department)
    {
        $dto = new DepartmentDataSourceModel();
        $dto->setId($department->getId());
        $dto->setName($department->getName());
        $dto->setCompanyId($department->getCompany()
            ->getId());
        return $dto;
    }

    public function toDepartmentDataSourceModels(array $departments): array
    {
        return array_map([
            $this,
            "toDepartmentDataSourceModel"
        ], $departments);
    }
}
