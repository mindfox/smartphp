<?php
namespace SmartPHP\Example\Services;

use SmartPHP\Collections\IteratorCollectors;
use SmartPHP\Collections\IteratorStreamInterface;
use SmartPHP\Doctrine\DoctrineCollection;
use SmartPHP\Example\Models\BusinessModels\CompanyBusinessModel;
use SmartPHP\Example\Models\BusinessModels\DepartmentBusinessModel;
use SmartPHP\Example\Models\DataSourceModels\CompanyDataSourceModel;
use SmartPHP\Example\Models\DataSourceModels\DepartmentDataSourceModel;
use SmartPHP\Example\Models\DoctrineEntities\CompanyEntity;
use SmartPHP\Example\Models\DoctrineEntities\DepartmentEntity;

class ConverterService
{

    public function toCompanyDataSourceModel(CompanyBusinessModel $companyBusinessModel): CompanyDataSourceModel
    {
        $dsm = new CompanyDataSourceModel();
        $dsm->setId($companyBusinessModel->getId());
        $dsm->setName($companyBusinessModel->getName());
        return $dsm;
    }

    public function toCompanyDataSourceModelStream(IteratorStreamInterface $companyBusinessModels): IteratorStreamInterface
    {
        return $companyBusinessModels->map([
            $this,
            "toCompanyDataSourceModel"
        ]);
    }

    public function toCompanyEntity(CompanyBusinessModel $company): CompanyEntity
    {
        $entity = new CompanyEntity();
        $entity->setId($company->getId());
        $entity->setName($company->getName());
        DoctrineCollection::create($entity->getDepartments())->addAll($this->toDepartmentEntityCollection($company->getDepartments(), $entity));
        return $entity;
    }

    public function toCompanyEntityStream(IteratorStreamInterface $companyEntities): IteratorStreamInterface
    {
        return $companyEntities->map([
            $this,
            "toCompanyEntity"
        ]);
    }

    public function toDepartmentDataSourceModel(DepartmentBusinessModel $departmentBusinessModel): DepartmentDataSourceModel
    {
        $dsm = new DepartmentDataSourceModel();
        $dsm->setId($departmentBusinessModel->getId());
        $dsm->setName($departmentBusinessModel->getName());
        if (! is_null($departmentBusinessModel->getCompany())) {
            $dsm->setCompanyId($departmentBusinessModel->getCompany()
                ->getId());
        }
        
        return $dsm;
    }

    public function toDepartmentDataSourceModelStream(IteratorStreamInterface $departments): IteratorStreamInterface
    {
        return $departments->map([
            $this,
            "toDepartmentDataSourceModel"
        ]);
    }

    public function toDepartmentEntity(DepartmentBusinessModel $department, CompanyEntity $company): DepartmentEntity
    {
        $entity = new DepartmentEntity();
        $entity->setId($department->getId());
        $entity->setName($department->getName());
        $entity->setCompany($company);
        return $entity;
    }

    public function toDepartmentEntityStream(IteratorStreamInterface $departmentBusinessModles, CompanyEntity $companyEntity): IteratorStreamInterface
    {
        $converter = $this;
        $functor = function ($department) use ($converter, $companyEntity) {
            $converter->toDepartmentEntity($department, $companyEntity);
        };
        return $departmentBusinessModles->map($functor);
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
        $bm->getDepartments()->addAll($this->fromDepartmentEntityStream(DoctrineCollection::create($company->getDepartments())->stream(), $bm)
            ->collect(IteratorCollectors::toArrayCollection()));
        return $bm;
    }

    public function fromCompanyEntityStream(IteratorStreamInterface $companyEntities): IteratorStreamInterface
    {
        return $companyEntities->map([
            $this,
            "fromCompanyEntity"
        ]);
    }

    public function fromDepartmentEntity(DepartmentEntity $department, CompanyBusinessModel $company = null): DepartmentBusinessModel
    {
        $bm = new DepartmentBusinessModel();
        $bm->setId($department->getId());
        $bm->setName($department->getName());
        $bm->setCompany($company ?? $this->fromCompanyEntity($department->getCompany()));
        return $bm;
    }

    public function fromDepartmentEntityStream(IteratorStreamInterface $departmentEntities, CompanyBusinessModel $companyBusinessModel = null): IteratorStreamInterface
    {
        $converter = $this;
        $functor = function ($departmentEntity) use ($converter, $companyBusinessModel) {
            return $converter->fromDepartmentEntity($departmentEntity, $companyBusinessModel);
        };
        return $departmentEntities->map($functor);
    }
}
