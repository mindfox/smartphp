<?php
namespace SmartPHP\Example\Services;

use SmartPHP\Collections\IteratorStreamInterface;
use SmartPHP\Example\Interfaces\ModelConverterServiceInterface;
use SmartPHP\Example\Models\BusinessModels\CompanyBusinessModel;
use SmartPHP\Example\Models\BusinessModels\DepartmentBusinessModel;
use SmartPHP\Example\Models\BusinessModels\EmployeeBusinessModel;
use SmartPHP\Example\Models\DataSourceModels\CompanyDataSourceModel;
use SmartPHP\Example\Models\DataSourceModels\DepartmentDataSourceModel;
use SmartPHP\Example\Models\DataSourceModels\EmployeeDataSourceModel;
use SmartPHP\Example\Models\DoctrineEntities\CompanyEntity;
use SmartPHP\Example\Models\DoctrineEntities\DepartmentEntity;
use SmartPHP\Example\Models\DoctrineEntities\EmployeeEntity;
use SmartPHP\Doctrine\DoctrineCollection;
use SmartPHP\Collections\IteratorCollectors;

class ModelConverterService implements ModelConverterServiceInterface
{

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\ModelConverterServiceInterface::toCompanyDataSourceModel()
     */
    public function toCompanyDataSourceModel(CompanyBusinessModel $company): CompanyDataSourceModel
    {
        $dsm = new CompanyDataSourceModel();
        $dsm->setId($company->getId());
        $dsm->setName($company->getName());
        return $dsm;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\ModelConverterServiceInterface::toCompanyDataSourceModels()
     */
    public function toCompanyDataSourceModels(IteratorStreamInterface $companies): IteratorStreamInterface
    {
        return $companies->map([
            $this,
            "toCompanyDataSourceModel"
        ]);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\ModelConverterServiceInterface::toCompanyEntity()
     */
    public function toCompanyEntity(CompanyBusinessModel $company): CompanyEntity
    {
        $entity = new CompanyEntity();
        $entity->setId($company->getId());
        $entity->setName($company->getName());
        DoctrineCollection::create($entity->getDepartments())->addAll($this->toDepartmentEntities($company->getDepartments()
            ->stream(), $entity)
            ->collect(IteratorCollectors::toArrayCollection()));
        return $entity;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\ModelConverterServiceInterface::toCompanyEntities()
     */
    public function toCompanyEntities(IteratorStreamInterface $companies): IteratorStreamInterface
    {
        return $companies->map([
            $this,
            "toCompanyEntity"
        ]);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\ModelConverterServiceInterface::toDepartmentDataSourceModel()
     */
    public function toDepartmentDataSourceModel(DepartmentBusinessModel $department): DepartmentDataSourceModel
    {
        $dsm = new DepartmentDataSourceModel();
        $dsm->setId($department->getId());
        $dsm->setName($department->getName());
        if (! is_null($department->getCompany())) {
            $dsm->setCompanyId($department->getCompany()
                ->getId());
        }
        return $dsm;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\ModelConverterServiceInterface::toDepartmentDataSourceModels()
     */
    public function toDepartmentDataSourceModels(IteratorStreamInterface $departments): IteratorStreamInterface
    {
        return $departments->map([
            $this,
            "toDepartmentDataSourceModel"
        ]);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\ModelConverterServiceInterface::toDepartmentEntity()
     */
    public function toDepartmentEntity(DepartmentBusinessModel $department, CompanyEntity $company = null): DepartmentEntity
    {
        $entity = new DepartmentEntity();
        $entity->setId($department->getId());
        $entity->setName($department->getName());
        $entity->setCompany($company ?? $this->toCompanyEntity($department->getCompany()));
//         var_dump($entity); die();
        return $entity;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\ModelConverterServiceInterface::toDepartmentEntities()
     */
    public function toDepartmentEntities(IteratorStreamInterface $departments, CompanyEntity $company = null): IteratorStreamInterface
    {
        $converter = $this;
        return $departments->map(function ($department) use ($converter, $company) {
            $converter->toDepartmentEntity($department, $company);
        });
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\ModelConverterServiceInterface::toEmployeeDataSourceModel()
     */
    public function toEmployeeDataSourceModel(EmployeeBusinessModel $employee): EmployeeDataSourceModel
    {
        $dsm = new EmployeeDataSourceModel();
        $dsm->setId($employee->getId());
        $dsm->setFirstName($employee->getFirstName());
        $dsm->setSecondName($employee->getSecondName());
        $dsm->setBirthDate($employee->getBirthDate());
        $dsm->setSalary($employee->getSalary());
        return $dsm;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\ModelConverterServiceInterface::toEmployeeDataSourceModels()
     */
    public function toEmployeeDataSourceModels(IteratorStreamInterface $employees): IteratorStreamInterface
    {
        return $employees->map([
            $this,
            "toEmployeeDataSourceModel"
        ]);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\ModelConverterServiceInterface::toEmployeeEntity()
     */
    public function toEmployeeEntity(EmployeeBusinessModel $employee): EmployeeEntity
    {
        $entity = new EmployeeEntity();
        $entity->setId($employee->getId());
        $entity->setFirstName($employee->getFirstName());
        $entity->setSecondName($employee->getSecondName());
        $entity->setBirthDate($employee->getBirthDate());
        $entity->setSalary($employee->getSalary());
        return $entity;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\ModelConverterServiceInterface::toEmployeeEntities()
     */
    public function toEmployeeEntities(IteratorStreamInterface $employees): IteratorStreamInterface
    {
        return $employees->map([
            $this,
            "toEmployeeEntity"
        ]);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\ModelConverterServiceInterface::fromCompanyDataSourceModel()
     */
    public function fromCompanyDataSourceModel(CompanyDataSourceModel $company): CompanyBusinessModel
    {
        $bm = new CompanyBusinessModel();
        $bm->setId($company->getId());
        $bm->setName($company->getName());
        return $bm;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\ModelConverterServiceInterface::fromCompanyEntity()
     */
    public function fromCompanyEntity(CompanyEntity $company): CompanyBusinessModel
    {
        $bm = new CompanyBusinessModel();
        $bm->setId($company->getId());
        $bm->setName($company->getName());
        $bm->getDepartments()->addAll($this->fromDepartmentEntities(DoctrineCollection::create($company->getDepartments())->stream(), $bm)
            ->collect(IteratorCollectors::toArrayCollection()));
        return $bm;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\ModelConverterServiceInterface::fromCompanyEntities()
     */
    public function fromCompanyEntities(IteratorStreamInterface $companyEntities): IteratorStreamInterface
    {
        return $companyEntities->map([
            $this,
            "fromCompanyEntity"
        ]);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\ModelConverterServiceInterface::fromDepartmentDataSourceModel()
     */
    public function fromDepartmentDataSourceModel(DepartmentDataSourceModel $department): DepartmentBusinessModel
    {
        $bm = new DepartmentBusinessModel();
        $bm->setId($department->getId());
        $bm->setName($department->getName());
        $bm->setCompany((new CompanyBusinessModel())->setId($department->getCompanyId()));
        return $bm;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\ModelConverterServiceInterface::fromDepartmentEntity()
     */
    public function fromDepartmentEntity(DepartmentEntity $department, CompanyBusinessModel $company = null): DepartmentBusinessModel
    {
        $bm = new DepartmentBusinessModel();
        $bm->setId($department->getId());
        $bm->setName($department->getName());
        $bm->setCompany($company ?? $this->fromCompanyEntity($department->getCompany()));
        return $bm;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\ModelConverterServiceInterface::fromDepartmentEntities()
     */
    public function fromDepartmentEntities(IteratorStreamInterface $departments, CompanyBusinessModel $company = null): IteratorStreamInterface
    {
        $converter = $this;
        return $departments->map(function ($department) use ($converter, $company) {
            return $converter->fromDepartmentEntity($department, $company);
        });
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\ModelConverterServiceInterface::fromEmployeeDataSourceModel()
     */
    public function fromEmployeeDataSourceModel(EmployeeDataSourceModel $employee): EmployeeBusinessModel
    {
        $bm = new EmployeeBusinessModel();
        $bm->setId($employee->getId());
        $bm->setFirstName($employee->getFirstName());
        $bm->setSecondName($employee->getSecondName());
        $bm->setBirthDate($employee->getBirthDate());
        $bm->setSalary($employee->getSalary());
        return $bm;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\ModelConverterServiceInterface::fromEmployeeEntity()
     */
    public function fromEmployeeEntity(EmployeeEntity $employee, DepartmentBusinessModel $department = null): EmployeeBusinessModel
    {
        $bm = new EmployeeBusinessModel();
        $bm->setId($employee->getId());
        $bm->setFirstName($employee->getFirstName());
        $bm->setSecondName($employee->getSecondName());
        $bm->setBirthDate($employee->getBirthDate());
        $bm->setSalary($employee->getSalary());
        return $bm;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\ModelConverterServiceInterface::fromEmployeeEntities()
     */
    public function fromEmployeeEntities(IteratorStreamInterface $employees, DepartmentBusinessModel $department = null): IteratorStreamInterface
    {
        $converter = $this;
        return $employees->map(function ($employee) use ($converter, $department) {
            return $converter->fromEmployeeEntity($employee, $department);
        });
    }
}
