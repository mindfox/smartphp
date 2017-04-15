<?php
namespace SmartPHP\Example\DataSources;

use SmartPHP\Example\Models\Dtos\CompanyDto;
use SmartPHP\Example\Services\CompanyServiceInterface;
use SmartPHP\Interfaces\DataSourceInterface;
use SmartPHP\Traits\ModelBinderTrait;

class CompanyDataSource implements DataSourceInterface
{
    use ModelBinderTrait;
    
    /**
     *
     * @var CompanyServiceInterface
     */
    private $companyService;
    
    public function __construct(CompanyServiceInterface $companyService)
    {
        $this->companyService= $companyService;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::fetch()
     */
    public function fetch(int $startRow, int $endRow): array
    {
        return $this->companyService->fetchAll();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::add()
     */
    public function add(array $data): array
    {
        $company = $this->bind($data, CompanyDto::class);
        $company = $this->companyService->add($company);
        return $this->unbind($company);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::update()
     */
    public function update(array $data, array $oldValues): array
    {
        $company = $this->bindMerged($data, $oldValues, CompanyDto::class);
        $company = $this->companyService->update($company);
        return $this->unbind($company);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::remove()
     */
    public function remove(array $data): array
    {
        $company = $this->bind($data, CompanyDto::class);
        $company = $this->companyService->remove($company);
        return $this->unbind($company);
    }
}
