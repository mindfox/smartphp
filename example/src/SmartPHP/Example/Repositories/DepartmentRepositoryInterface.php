<?php
namespace SmartPHP\Example\Repositories;

use SmartPHP\Example\Models\Entities\DepartmentEntity;

interface DepartmentRepositoryInterface
{

    public function fetchAll(): array;

    public function fetchOne(DepartmentEntity $company): DepartmentEntity;

    public function fetch(int $startRow, int $endRow): array;

    public function add(DepartmentEntity $company): DepartmentEntity;

    public function update(DepartmentEntity $company): DepartmentEntity;

    public function remove(DepartmentEntity $company): DepartmentEntity;
}
