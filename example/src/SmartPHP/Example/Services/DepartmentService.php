<?php
namespace SmartPHP\Example\Services;

use SmartPHP\Example\Repositories\DepartmentRepositoryInterface;
use SmartPHP\Example\Models\Dtos\DepartmentDto;
use SmartPHP\Example\Converters\DepartmentConverterTrait;

class DepartmentService implements DepartmentServiceInterface
{
    
    use DepartmentConverterTrait;
    
    /**
     *
     * @var DepartmentRepositoryInterface
     */
    private $departmentRepository;
    
    public function __construct(DepartmentRepositoryInterface $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\DepartmentServiceInterface::fetchAll()
     */
    public function fetchAll(): array
    {
        $entities = $this->departmentRepository->fetchAll();
        return $this->toDepartmentDtos($entities);
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\DepartmentServiceInterface::fetchOne()
     */
    public function fetchOne(DepartmentDto $department): DepartmentDto
    {
        $department = $this->toDepartmentEntity($department);
        $department = $this->departmentRepository->fetchOne($department);
        $department = $this->toDepartmentDto($department);
        return $department;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\DepartmentServiceInterface::fetch()
     */
    public function fetch(int $startRow, int $endRow): array
    {
        return $this->fetchAll();
//         if (is_null($department)) {
//             $department = $this->departmentRepository->fetch();
//         } else {
//             $department = $this->toDepartmentEntity($department);
//             $department = $this->departmentRepository->fetch($department);
//         }
//         $department = $this->toDepartmentDto($department);
//         return $department;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\DepartmentServiceInterface::add()
     */
    public function add(DepartmentDto $department): DepartmentDto
    {
        $department = $this->toDepartmentEntity($department);
        $department = $this->departmentRepository->add($department);
        $department = $this->toDepartmentDto($department);
        return $department;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\DepartmentServiceInterface::update()
     */
    public function update(DepartmentDto $department): DepartmentDto
    {
        $department = $this->toDepartmentEntity($department);
        $department = $this->departmentRepository->update($department);
        $department = $this->toDepartmentDto($department);
        return $department;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Example\Sevices\DepartmentServiceInterface::remove()
     */
    public function remove(DepartmentDto $department): DepartmentDto
    {
        $department = $this->toDepartmentEntity($department);
        $department = $this->departmentRepository->remove($department);
        $department = $this->toDepartmentDto($department);
        return $department;
    }
}
