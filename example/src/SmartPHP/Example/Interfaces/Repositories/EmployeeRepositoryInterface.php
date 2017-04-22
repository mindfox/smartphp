<?php
namespace SmartPHP\Example\Interfaces\Repositories;

use SmartPHP\Example\Models\DoctrineEntities\EmployeeEntity;

interface EmployeeRepositoryInterface
{

    public function fetchAll(): array;

    public function fetchOne(EmployeeEntity $company): EmployeeEntity;

    public function fetch(int $startRow, int $endRow): array;

    public function add(EmployeeEntity $company): EmployeeEntity;

    public function update(EmployeeEntity $company): EmployeeEntity;

    public function remove(EmployeeEntity $company): EmployeeEntity;
}
