<?php
namespace SmartPHP\Example\Services\ConverterService;

use SmartPHP\Example\Interfaces\ConverterServices\CompanyConverterServiceInterface;
use SmartPHP\Example\Models\DataSourceModels\CompanyDataSourceModel;
use Smartphp\example\models\BusinessModels\CompanyBusinessModel;
use SmartPHP\Example\Models\DoctrineEntities\CompanyEntity;
use SmartPHP\Example\Interfaces\ConverterServices\DepartmentConverterServiceInterface;
use SmartPHP\Doctrine\DoctrineCollection;

class CompanyConverterService implements CompanyConverterServiceInterface
{

    private $departmentConverter;

    public function __construct(DepartmentConverterServiceInterface $departmentConverter)
    {
        $this->departmentConverter = $departmentConverter;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\ConverterServices\CompanyConverterServiceInterface::convertDataSourceModelToBusinessModel()
     */
    public function convertDataSourceModelToBusinessModel(CompanyDataSourceModel $company): CompanyBusinessModel
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
     * @see \SmartPHP\Example\Interfaces\ConverterServices\CompanyConverterServiceInterface::convertBusinessModelToDataSourceModel()
     */
    public function convertBusinessModelToDataSourceModel(CompanyBusinessModel $company): CompanyDataSourceModel
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
     * @see \SmartPHP\Example\Interfaces\ConverterServices\CompanyConverterServiceInterface::convertBusinessModelToEntity()
     */
    public function convertBusinessModelToEntity(CompanyBusinessModel $company): CompanyEntity
    {
        $entity = new CompanyEntity();
        $entity->setId($company->getId());
        $entity->setName($company->getName());
        DoctrineCollection::create($entity->getDepartments())->addAll($company->getDepartments()
            ->stream()
            ->map([
            $this->departmentConverter,
            "convertBusinessModelToEntity"
            ]));
        return $entity;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\ConverterServices\CompanyConverterServiceInterface::convertEntityToBusinessModel()
     */
    public function convertEntityToBusinessModel(CompanyEntity $company): CompanyBusinessModel
    {
        $bm = new CompanyBusinessModel();
        $bm->setId($company->getId());
        $bm->setName($company->getName());
        $func = [
            $this->departmentConverter,
            "convnertEntityToBusinessModel"
        ];
        $bm->setDepartments($company->getDepartments()
            ->map($func)
            ->toArray());
        return $bm;
    }
}
