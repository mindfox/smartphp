<?php
namespace SmartPHP\Example\Services\BusinessServices;

use SmartPHP\Example\Interfaces\BusinessServices\CompanyBusinessServiceInterface;
use SmartPHP\Example\Interfaces\Repositories\CompanyRepositoryInterface;
use SmartPHP\Collections\Collections;
use SmartPHP\Example\Services\ConverterService;
use SmartPHP\Example\Models\BusinessModels\CompanyBusinessModel;

class CompanyBusinessService implements CompanyBusinessServiceInterface
{

    private $companyRepository;
    
    /**
     * 
     * @var ConverterService
     */
    private $converter;
    
    public function __construct(CompanyRepositoryInterface $companyRepository, ConverterService $converter)
    {
        $this->companyRepository = $companyRepository;
        $this->converter = $converter;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\BusinessServices\CompanyBusinessServiceInterface::fetchAll()
     */
    public function fetchAll(): array
    {
        $companies = $this->companyRepository->fetchAll();
        $companies = $this->converter->fromCompanyEntities(Collections::newArrayCollection($companies));
        return $companies->toArray();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\BusinessServices\CompanyBusinessServiceInterface::fetchOne()
     */
    public function fetchOne(CompanyBusinessModel $company): CompanyBusinessModel
    {
        // TODO: Auto-generated method stub
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\BusinessServices\CompanyBusinessServiceInterface::fetch()
     */
    public function fetch(int $startRow, int $endRow): array
    {
        $companies = $this->companyRepository->fetch($startRow, $endRow);
        $companies = $this->converter->fromCompanyEntities(Collections::newArrayCollection($companies));
        return $companies->toArray();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\BusinessServices\CompanyBusinessServiceInterface::add()
     */
    public function add(CompanyBusinessModel $company): CompanyBusinessModel
    {
        // TODO: Auto-generated method stub
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\BusinessServices\CompanyBusinessServiceInterface::update()
     */
    public function update(CompanyBusinessModel $company): CompanyBusinessModel
    {
        // TODO: Auto-generated method stub
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\BusinessServices\CompanyBusinessServiceInterface::remove()
     */
    public function remove(CompanyBusinessModel $company): CompanyBusinessModel
    {
        // TODO: Auto-generated method stub
    }
}
