<?php
namespace SmartPHP\Example\Services;

use SmartPHP\Interfaces\DataSourceServiceInterface;
use SmartPHP\Interfaces\DataSourceMessageInterface;
use Doctrine\ORM\EntityRepository;
use SmartPHP\Example\Converters\CompanyConverterTrait;
use SmartPHP\Example\Converters\ModelBinderTrait;
use SmartPHP\Example\Models\Dtos\CompanyDto;
use SmartPHP\Example\Repositories\CompanyRepository;

class CompanyDSService implements DataSourceServiceInterface
{
    use ModelBinderTrait;
    use CompanyConverterTrait;
    
    /**
     * 
     * @var CompanyRepository
     */
    private $companyRepository;
    
    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::fetch()
     */
    public function fetch(DataSourceMessageInterface $message): DataSourceMessageInterface
    {
        $companies = $this->companyRepository->findAll();
        $data = $this->toCompanyDtos($companies);
        $message->setData($data);
        $message->setStartRow(0);
        $message->setEndRow(count($data)-1);
        $message->setTotalRows(count($data));
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
        $data = $message->getData();
        $dto = $this->bind($data, CompanyDto::class);
        $company = $this->toCompanyEntity($dto);
        $company = $this->companyRepository->add($company);
        $dto = $this->toCompanyDto($company);
        $message->setData($dto);
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