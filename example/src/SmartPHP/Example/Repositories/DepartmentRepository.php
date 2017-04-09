<?php
namespace SmartPHP\Example\Repositories;

use SmartPHP\Doctrine\GenericDataSourceRepository;
use SmartPHP\Example\Models\Entities\CompanyEntity;
use SmartPHP\Example\Models\Entities\DepartmentEntity;
use Doctrine\ORM\EntityManagerInterface;

class DepartmentRepository extends GenericDataSourceRepository implements DepartmentRepositoryInterface
{

    /**
     *
     * @var CompanyRepositoryInterface
     */
    private $companyRepository;

    public function __construct(EntityManagerInterface $entityManager, CompanyRepositoryInterface $companyRepository)
    {
        parent::__construct($entityManager);
        $this->companyRepository = $companyRepository;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Repositories\DepartmentRepositoryInterface::fetchAll()
     */
    public function fetchAll(): array
    {
        return $this->fetchAllEntities(DepartmentEntity::class);
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
    public function fetch(DepartmentEntity $department = null)
    {
        return $this->fetchEntity($department);
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