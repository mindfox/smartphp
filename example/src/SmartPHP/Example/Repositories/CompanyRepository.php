<?php
namespace SmartPHP\Example\Repositories;

use SmartPHP\Doctrine\GenericEntityRepository;
use SmartPHP\Example\Models\Entities\CompanyEntity;

class CompanyRepository extends GenericEntityRepository implements CompanyRepositoryInterface
{

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\CompanyRepositoryInterface::fetchAll()
     */
    public function fetchAll(): array
    {
        return $this->fetchAllEntities();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\CompanyRepositoryInterface::fetchOne()
     */
    public function fetchOne(CompanyEntity $company): CompanyEntity
    {
        return $this->fetchOneEntity($company);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\CompanyRepositoryInterface::fetch()
     */
    public function fetch(CompanyEntity $company = null)
    {
        return $this->fetchEntity($company);
    }

    /**
     *
     * @param CompanyEntity $company            
     * @return CompanyEntity
     */
    public function add(CompanyEntity $company): CompanyEntity
    {
        return $this->addEntity($company);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\CompanyRepositoryInterface::update()
     */
    public function update(CompanyEntity $company): CompanyEntity
    {
        return $this->updateEntity($company);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\CompanyRepositoryInterface::remove()
     */
    public function remove(CompanyEntity $company): CompanyEntity
    {
        return $this->removeEntity($company);
    }
}