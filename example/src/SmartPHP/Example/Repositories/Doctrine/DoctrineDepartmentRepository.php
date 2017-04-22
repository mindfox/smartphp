<?php
namespace SmartPHP\Example\Repositories\Doctrine;

use SmartPHP\Doctrine\DoctrineDataSourceEntityRepository;
use SmartPHP\Example\Models\Entities\CompanyEntity;
use SmartPHP\Example\Models\Entities\DepartmentEntity;
use SmartPHP\Example\Repositories\DepartmentRepositoryInterface;

class DoctrineDepartmentRepository extends DoctrineDataSourceEntityRepository implements DepartmentRepositoryInterface
{

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\DepartmentRepositoryInterface::fetchAll()
     */
    public function fetchAll(): array
    {
        return $this->fetchAllEntities();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\DepartmentRepositoryInterface::fetchOne()
     */
    public function fetchOne(DepartmentEntity $department): DepartmentEntity
    {
        return $this->fetchOneEntity($department);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\DepartmentRepositoryInterface::fetch()
     */
    public function fetch(int $startRow, int $endRow): array
    {
        return $this->fetch($startRow, $endRow);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\DepartmentRepositoryInterface::add()
     */
    public function add(DepartmentEntity $department): DepartmentEntity
    {
        /**
         *
         * @var CompanyEntity $company
         */
        $company = $this->getEntityManager()->find(CompanyEntity::class, $department->getCompany());
        $company->addDepartment($department);
        $department->setCompany($company);
        $this->companyRepository->update($company);
        return $this->updateEntity($department);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\DepartmentRepositoryInterface::update()
     */
    public function update(DepartmentEntity $department): DepartmentEntity
    {
        return $this->updateEntity($department);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\DepartmentRepositoryInterface::remove()
     */
    public function remove(DepartmentEntity $department): DepartmentEntity
    {
        return $this->removeEntity($department);
    }
}
