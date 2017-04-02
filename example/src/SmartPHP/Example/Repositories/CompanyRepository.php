<?php
namespace SmartPHP\Example\Repositories;

use Doctrine\ORM\EntityRepository;
use SmartPHP\Example\Models\Entities\CompanyEntity;

class CompanyRepository extends EntityRepository implements CompanyRepositoryInterface
{

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\CompanyRepositoryInterface::fetchAll()
     */
    public function fetchAll(): array
    {
        // TODO: Auto-generated method stub
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\CompanyRepositoryInterface::fetchOne()
     */
    public function fetchOne(CompanyEntity $company): CompanyEntity
    {
        // TODO: Auto-generated method stub
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\CompanyRepositoryInterface::fetch()
     */
    public function fetch(CompanyEntity $company = null)
    {
        // TODO: Auto-generated method stub
    }

    /**
     * 
     * @param CompanyEntity $company
     * @return CompanyEntity
     */
    public function add(CompanyEntity $company): CompanyEntity
    {
        $this->getEntityManager()->persist($company);
        $this->getEntityManager()->flush();
        return $company;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\CompanyRepositoryInterface::update()
     */
    public function update(CompanyEntity $company): CompanyEntity
    {
        // TODO: Auto-generated method stub
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\CompanyRepositoryInterface::remove()
     */
    public function remove(CompanyEntity $company): CompanyEntity
    {
        // TODO: Auto-generated method stub
    }
}