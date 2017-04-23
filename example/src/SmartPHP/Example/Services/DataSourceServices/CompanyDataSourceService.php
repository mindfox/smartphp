<?php
namespace SmartPHP\Example\Services\DataSourceServices;

use SmartPHP\Example\Interfaces\DataSourceServices\CompanyDataSourceServiceInterface;
use SmartPHP\Example\Interfaces\Repositories\CompanyRepositoryInterface;
use SmartPHP\Example\Models\Converters\CompanyConverterTrait;
use SmartPHP\Example\Models\DataSourceModels\CompanyDataSourceModel;
use SmartPHP\Example\Services\BusinessServices\CompanyBusinessService;
use SmartPHP\Example\Services\ConverterService;
use SmartPHP\Collections\Collections;

class CompanyDataSourceService implements CompanyDataSourceServiceInterface
{
    
    use CompanyConverterTrait;

    /**
     *
     * @var CompanyRepositoryInterface
     */
    private $companyRepository;
    private $companyService;
    private $converter;

    public function __construct(CompanyRepositoryInterface $companyRepository, CompanyBusinessService $companyService, ConverterService $converterService)
    {
        $this->companyRepository = $companyRepository;
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
        $entities = $this->companyRepository->fetchAll();
        return $this->toCompanyDataSourceModels($entities);
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
        $companies = $this->companyService->fetchAll();
        $companies = $this->converter->toCompanyDataSourceModels(Collections::newArrayCollection($companies));
        return $companies->toArray();
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
