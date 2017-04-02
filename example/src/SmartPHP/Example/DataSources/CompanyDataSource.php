<?php
namespace SmartPHP\Example\DataSources;

use SmartPHP\Interfaces\DataSourceInterface;
use SmartPHP\Interfaces\DataSourceMessageInterface;
use SmartPHP\Traits\ModelBinderTrait;
use SmartPHP\Example\Services\CompanyServiceInterface;
use SmartPHP\Example\Models\Dtos\CompanyDto;

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
    public function fetch(DataSourceMessageInterface $message): DataSourceMessageInterface
    {
        $companies = $this->companyService->fetchAll();
        $message->setData($companies);
        $message->setStartRow(0);
        $message->setEndRow(count($companies)-1);
        $message->setTotalRows(count($companies));
        return $message;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::add()
     */
    public function add(DataSourceMessageInterface $message): DataSourceMessageInterface
    {
        $company = $this->bind($message->getData(), CompanyDto::class);
        $company = $this->companyService->add($company);
        $message->setData($company);
        return $message;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::update()
     */
    public function update(DataSourceMessageInterface $message): DataSourceMessageInterface
    {
        return $message;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::remove()
     */
    public function remove(DataSourceMessageInterface $message): DataSourceMessageInterface
    {
        return $message;
    }
}