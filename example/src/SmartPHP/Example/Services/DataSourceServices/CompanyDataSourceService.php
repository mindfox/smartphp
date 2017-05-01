<?php
namespace SmartPHP\Example\Services\DataSourceServices;

use SmartPHP\Example\Interfaces\BusinessServices\CompanyBusinessServiceInterface;
use SmartPHP\Example\Interfaces\DataSourceServices\CompanyDataSourceServiceInterface;
use SmartPHP\Example\Interfaces\ModelConverterServiceInterface;
use SmartPHP\Example\Models\DataSourceModels\CompanyDataSourceModel;

class CompanyDataSourceService implements CompanyDataSourceServiceInterface
{
    /**
     *
     * @var CompanyBusinessServiceInterface
     */
    private $companyService;
    
    /**
     *
     * @var ModelConverterServiceInterface
     */
    private $converter;

    public function __construct(CompanyBusinessServiceInterface $companyService, ModelConverterServiceInterface $converterService)
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
        return $this->converter->toCompanyDataSourceModels($this->companyService->fetchAll())->toArray();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\CompanyServiceInterface::fetchOne()
     */
    public function fetchOne(CompanyDataSourceModel $company): CompanyDataSourceModel
    {
        $company = $this->converter->fromCompanyDataSourceModel($company);
        $company = $this->companyService->fetchOne($company);
        $company = $this->converter->toCompanyDataSourceModel($company);
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
        return $this->converter->toCompanyDataSourceModels($this->companyService->fetch($startRow, $endRow))->toArray();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\CompanyServiceInterface::add()
     */
    public function add(CompanyDataSourceModel $company): CompanyDataSourceModel
    {
        $company = $this->converter->fromCompanyDataSourceModel($company);
        $company = $this->companyService->add($company);
        $company = $this->converter->toCompanyDataSourceModel($company);
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
        $company = $this->converter->fromCompanyDataSourceModel($company);
        $company = $this->companyService->update($company);
        $company = $this->converter->toCompanyDataSourceModel($company);
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
        $company = $this->converter->fromCompanyDataSourceModel($company);
        $company = $this->companyService->remove($company);
        $company = $this->converter->toCompanyDataSourceModel($company);
        return $company;
    }
}
