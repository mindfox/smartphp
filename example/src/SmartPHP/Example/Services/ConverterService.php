<?php
namespace SmartPHP\Example\Services;

use SmartPHP\Collections\CollectionInterface;
use SmartPHP\Collections\IteratorCollectors;
use SmartPHP\Doctrine\DoctrineCollection;
use SmartPHP\Example\Models\BusinessModels\CompanyBusinessModel;
use SmartPHP\Example\Models\BusinessModels\DepartmentBusinessModel;
use SmartPHP\Example\Models\DataSourceModels\CompanyDataSourceModel;
use SmartPHP\Example\Models\DoctrineEntities\CompanyEntity;
use SmartPHP\Example\Models\DoctrineEntities\DepartmentEntity;

class ConverterService
{

    public function toCompanyDataSourceModel(CompanyBusinessModel $company): CompanyDataSourceModel
    {
        $dsm = new CompanyDataSourceModel();
        $dsm->setId($company->getId());
        $dsm->setName($company->getName());
        return $dsm;
    }
    
    public function toCompanyDataSourceModels(CollectionInterface $companies): CollectionInterface
    {
        return $companies->stream()->map([$this, "toCompanyDataSourceModel"])->collect(IteratorCollectors::toArrayCollection());
    }

    public function toCompanyEntity(CompanyBusinessModel $company): CompanyEntity
    {
        $entity = new CompanyEntity();
        $entity->setId($company->getId());
        $entity->setName($company->getName());
        DoctrineCollection::create($entity->getDepartments())->addAll($this->toDepartmentEntities($company->getDepartments(), $entity));
        return $entity;
    }

    public function toDepartmentEntity(DepartmentBusinessModel $department, CompanyEntity $company): DepartmentEntity
    {
        $entity = new DepartmentEntity();
        $entity->setId($department->getId());
        $entity->setName($department->getName());
        $entity->setCompany($company);
        return $entity;
    }

    public function toDepartmentEntities(CollectionInterface $departments, CompanyEntity $company): \Slim\Interfaces\CollectionInterface
    {
        $converter = $this;
        $functor = function ($department) use ($converter, $company) {
            $converter->toDepartmentEntity($department, $company);
        };
        return $departments->stream()
            ->map($functor)
            ->collect(IteratorCollectors::toArrayCollection());
    }

    public function fromCompanyDataSourceModel(CompanyDataSourceModel $company): CompanyBusinessModel
    {
        $bm = new CompanyBusinessModel();
        $bm->setId($company->getId());
        $bm->setName($company->getName());
        return $bm;
    }

    public function fromCompanyEntity(CompanyEntity $company): CompanyBusinessModel
    {
        $bm = new CompanyBusinessModel();
        $bm->setId($company->getId());
        $bm->setName($company->getName());
        $bm->getDepartments()->addAll($this->fromDepartmentEntities(DoctrineCollection::create($company->getDepartments()), $bm));
        return $bm;
    }
    
    public function fromCompanyEntities(CollectionInterface $companies): CollectionInterface
    {
        return $companies->stream()->map([$this, "fromCompanyEntity"])->collect(IteratorCollectors::toArrayCollection());
    }

    public function fromDepartmentEntity(DepartmentEntity $department, CompanyBusinessModel $company): DepartmentBusinessModel
    {
        $bm = new DepartmentBusinessModel();
        $bm->setId($department->getId());
        $bm->setName($department->getName());
        $bm->setCompany($company);
        return $bm;
    }

    public function fromDepartmentEntities(CollectionInterface $departments, CompanyBusinessModel $company): CollectionInterface
    {
        $converter = $this;
        $functor = function ($department) use ($converter, $company) {
            return $converter->fromDepartmentEntity($department, $company);
        };
        return $departments->stream()
            ->map($functor)
            ->collect(IteratorCollectors::toArrayCollection());
    }
}
