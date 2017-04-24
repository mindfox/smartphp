<?php
namespace SmartPHP\Example\Interfaces\Repositories;

use SmartPHP\Collections\IteratorStreamInterface;
use SmartPHP\Example\Models\DoctrineEntities\EmployeeEntity;

interface EmployeeRepositoryInterface
{

    public function fetchAll(): IteratorStreamInterface;

    public function fetchOne(EmployeeEntity $company): EmployeeEntity;

    public function fetch(int $startRow, int $endRow): IteratorStreamInterface;

    public function add(EmployeeEntity $company): EmployeeEntity;

    public function update(EmployeeEntity $company): EmployeeEntity;

    public function remove(EmployeeEntity $company): EmployeeEntity;
}
