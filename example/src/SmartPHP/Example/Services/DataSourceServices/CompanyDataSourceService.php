<?php
namespace SmartPHP\Example\Services\DataSourceServices;

use SmartPHP\Example\Interfaces\DataSourceServices\CompanyDataSourceServiceInterface;
use SmartPHP\Example\Interfaces\Repositories\CompanyRepositoryInterface;
use SmartPHP\Example\Models\Converters\CompanyConverterTrait;
use SmartPHP\Example\Models\DataSourceModels\CompanyDataSourceModel;

class CompanyDataSourceService implements CompanyDataSourceServiceInterface
{
    
    use CompanyConverterTrait;

    /**
     *
     * @var CompanyRepositoryInterface
     */
    private $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
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
        return $this->fetchAll();
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
