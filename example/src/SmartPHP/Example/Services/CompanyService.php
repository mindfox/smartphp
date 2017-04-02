<?php
namespace SmartPHP\Example\Services;

use SmartPHP\Example\Repositories\CompanyRepositoryInterface;
use SmartPHP\Example\Models\Dtos\CompanyDto;
use SmartPHP\Example\Converters\CompanyConverterTrait;

class CompanyService implements CompanyServiceInterface
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
        return $this->toCompanyDtos($entities);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\CompanyServiceInterface::fetchOne()
     */
    public function fetchOne(CompanyDto $company): CompanyDto
    {
        $company = $this->toCompanyEntity($company);
        $company = $this->companyRepository->fetchOne($company);
        $company = $this->toCompanyDto($company);
        return $company;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\CompanyServiceInterface::fetch()
     */
    public function fetch(CompanyDto $company = null)
    {
        if (is_null($company)) {
            $company = $this->companyRepository->fetch();
        } else {
            $company = $this->toCompanyEntity($company);
            $company = $this->companyRepository->fetch($company);
        }
        $company = $this->toCompanyDto($company);
        return $company;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\CompanyServiceInterface::add()
     */
    public function add(CompanyDto $company): CompanyDto
    {
        $company = $this->toCompanyEntity($company);
        $company = $this->companyRepository->add($company);
        $company = $this->toCompanyDto($company);
        return $company;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\CompanyServiceInterface::update()
     */
    public function update(CompanyDto $company): CompanyDto
    {
        $company = $this->toCompanyEntity($company);
        $company = $this->companyRepository->update($company);
        $company = $this->toCompanyDto($company);
        return $company;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\CompanyServiceInterface::remove()
     */
    public function remove(CompanyDto $company): CompanyDto
    {
        $company = $this->toCompanyEntity($company);
        $company = $this->companyRepository->remove($company);
        $company = $this->toCompanyDto($company);
        return $company;
    }
}