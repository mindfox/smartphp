<?php
namespace SmartPHP\Example\Services\DataSourceServices;

use SmartPHP\Example\Interfaces\BusinessServices\CompanyBusinessServiceInterface;
use SmartPHP\Example\Interfaces\DataSourceServices\CompanyDataSourceServiceInterface;
use SmartPHP\Example\Models\DataSourceModels\CompanyDataSourceModel;
use SmartPHP\Example\Services\BusinessServices\CompanyBusinessService;
use SmartPHP\Example\Services\ConverterService;

class CompanyDataSourceService implements CompanyDataSourceServiceInterface
{
    /**
     * 
     * @var CompanyBusinessServiceInterface
     */
    private $companyService;
    
    /**
     * 
     * @var ConverterService
     */
    private $converter;

    public function __construct(CompanyBusinessService $companyService, ConverterService $converterService)
    {
        $this->companyService = $companyService;
        $this->converter = $converterService;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\CompanyServiceInterface::fetchAll()
     */
    public function fetchAll(): array
    {
        return $this->converter->toCompanyDataSourceModelStream($this->companyService->fetchAll())->toArray();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\CompanyServiceInterface::fetchOne()
     */
    public function fetchOne(CompanyDataSourceModel $company): CompanyDataSourceModel
    {
        $company = $this->toCompanyEntity($company);
        $company = $this->companyRepository->fetchOne($company);
        $company = $this->toCompanyDataSourceModel($company);
        return $company;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\CompanyServiceInterface::fetch()
     */
    public function fetch(int $startRow, int $endRow): array
    {
        return $this->converter->toCompanyDataSourceModelStream($this->companyService->fetch($startRow, $endRow))->toArray();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\CompanyServiceInterface::add()
     */
    public function add(CompanyDataSourceModel $company): CompanyDataSourceModel
    {
        $company = $this->toCompanyEntity($company);
        $company = $this->companyRepository->add($company);
        $company = $this->toCompanyDataSourceModel($company);
        return $company;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\CompanyServiceInterface::update()
     */
    public function update(CompanyDataSourceModel $company): CompanyDataSourceModel
    {
        $company = $this->toCompanyEntity($company);
        $company = $this->companyRepository->update($company);
        $company = $this->toCompanyDataSourceModel($company);
        return $company;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\CompanyServiceInterface::remove()
     */
    public function remove(CompanyDataSourceModel $company): CompanyDataSourceModel
    {
        $company = $this->toCompanyEntity($company);
        $company = $this->companyRepository->remove($company);
        $company = $this->toCompanyDataSourceModel($company);
        return $company;
    }
}
