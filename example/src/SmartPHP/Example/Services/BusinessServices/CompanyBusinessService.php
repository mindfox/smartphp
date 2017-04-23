<?php
namespace SmartPHP\Example\Services\BusinessServices;

use SmartPHP\Example\Interfaces\BusinessServices\CompanyBusinessServiceInterface;
use SmartPHP\Example\Interfaces\Repositories\CompanyRepositoryInterface;
use Smartphp\example\models\BusinessModels\CompanyBusinessModel;

class CompanyBusinessService implements CompanyBusinessServiceInterface
{

    private $companyRepository;
    
    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\BusinessServices\CompanyBusinessServiceInterface::fetchAll()
     */
    public function fetchAll()
    {
        // TODO: Auto-generated method stub
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\BusinessServices\CompanyBusinessServiceInterface::fetchOne()
     */
    public function fetchOne(CompanyBusinessModel $company)
    {
        // TODO: Auto-generated method stub
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\BusinessServices\CompanyBusinessServiceInterface::fetch()
     */
    public function fetch($startRow, $endRow)
    {
        // TODO: Auto-generated method stub
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\BusinessServices\CompanyBusinessServiceInterface::add()
     */
    public function add(CompanyBusinessModel $company)
    {
        // TODO: Auto-generated method stub
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\BusinessServices\CompanyBusinessServiceInterface::update()
     */
    public function update(CompanyBusinessModel $company)
    {
        // TODO: Auto-generated method stub
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Interfaces\BusinessServices\CompanyBusinessServiceInterface::remove()
     */
    public function remove(CompanyBusinessModel $company)
    {
        // TODO: Auto-generated method stub
    }
}
