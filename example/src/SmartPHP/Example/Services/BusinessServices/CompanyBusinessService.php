<?php
namespace SmartPHP\Example\Services\BusinessServices;

use SmartPHP\Collections\IteratorStreamInterface;
use SmartPHP\Example\Interfaces\BusinessServices\CompanyBusinessServiceInterface;
use SmartPHP\Example\Interfaces\ModelConverterServiceInterface;
use SmartPHP\Example\Interfaces\Repositories\CompanyRepositoryInterface;
use SmartPHP\Example\Models\BusinessModels\CompanyBusinessModel;

class CompanyBusinessService implements CompanyBusinessServiceInterface
{

    private $companyRepository;

    /**
     *
     * @var ModelConverterServiceInterface
     */
    private $converter;

    public function __construct(CompanyRepositoryInterface $companyRepository, ModelConverterServiceInterface $converter)
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
    public function fetchAll(): IteratorStreamInterface
    {
        return $this->converter->fromCompanyEntities($this->companyRepository->fetchAll());
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
    public function fetch(int $startRow, int $endRow): IteratorStreamInterface
    {
        return $this->converter->fromCompanyEntities($this->companyRepository->fetch($startRow, $endRow));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\BusinessServices\CompanyBusinessServiceInterface::add()
     */
    public function add(CompanyBusinessModel $company): CompanyBusinessModel
    {
        $company= $this->converter->toCompanyEntity($company);
        $company= $this->companyRepository->add($company);
        $company = $this->converter->fromCompanyEntity($company);
        return $company;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\BusinessServices\CompanyBusinessServiceInterface::update()
     */
    public function update(CompanyBusinessModel $company): CompanyBusinessModel
    {
        $company = $this->converter->toCompanyEntity($company);
        $company = $this->companyRepository->update($company);
        $company = $this->converter->fromCompanyEntity($company);
        return $company;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\BusinessServices\CompanyBusinessServiceInterface::remove()
     */
    public function remove(CompanyBusinessModel $company): CompanyBusinessModel
    {
        $company = $this->converter->toCompanyEntity($company);
        $company = $this->companyRepository->remove($company);
        $company = $this->converter->fromCompanyEntity($company);
        return $company;
    }
}
