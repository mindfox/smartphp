<?php
namespace SmartPHP\Example\Interfaces\Repositories;

use SmartPHP\Example\Models\DoctrineEntities\DepartmentEntity;
use SmartPHP\Collections\IteratorStreamInterface;

interface DepartmentRepositoryInterface
{

    public function fetchAll(): IteratorStreamInterface;

    public function fetchOne(DepartmentEntity $company): DepartmentEntity;

    public function fetch(int $startRow, int $endRow): IteratorStreamInterface;

    public function add(DepartmentEntity $company): DepartmentEntity;

    public function update(DepartmentEntity $company): DepartmentEntity;

    public function remove(DepartmentEntity $company): DepartmentEntity;
}
