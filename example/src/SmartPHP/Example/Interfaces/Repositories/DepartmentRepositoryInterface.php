<?php
namespace SmartPHP\Example\Interfaces\Repositories;

use SmartPHP\Example\Models\DoctrineEntities\DepartmentEntity;

interface DepartmentRepositoryInterface
{

    public function fetchAll(): array;

    public function fetchOne(DepartmentEntity $company): DepartmentEntity;

    public function fetch(int $startRow, int $endRow): array;

    public function add(DepartmentEntity $company): DepartmentEntity;

    public function update(DepartmentEntity $company): DepartmentEntity;

    public function remove(DepartmentEntity $company): DepartmentEntity;
}
