<?php
namespace SmartPHP\Example\Services\DoctrineRepositories;

use SmartPHP\Doctrine\DoctrineDataSourceEntityRepository;
use SmartPHP\Example\Models\DoctrineEntities\CompanyEntity;
use SmartPHP\Example\Interfaces\Repositories\CompanyRepositoryInterface;
use Sabertooth\IteratorStreams\IteratorStreamInterface;
use Sabertooth\IteratorStreams\IteratorStream;

class DoctrineCompanyRepository extends DoctrineDataSourceEntityRepository implements CompanyRepositoryInterface
{

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\CompanyRepositoryInterface::fetchAll()
     */
    public function fetchAll(): IteratorStreamInterface
    {
        return IteratorStream::create($this->fetchAllEntities());
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\CompanyRepositoryInterface::fetchOne()
     */
    public function fetchOne(CompanyEntity $company): CompanyEntity
    {
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\CompanyRepositoryInterface::fetch()
     */
    public function fetch(int $startRow, int $endRow): IteratorStreamInterface
    {
        return IteratorStream::create($this->fetchEntities($startRow, $endRow));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\CompanyRepositoryInterface::add()
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
