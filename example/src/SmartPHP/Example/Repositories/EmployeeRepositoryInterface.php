<?php
namespace SmartPHP\Example\Repositories;

use SmartPHP\Example\Models\Entities\EmployeeEntity;

interface EmployeeRepositoryInterface
{

    public function fetchAll(): array;

    public function fetchOne(EmployeeEntity $company): EmployeeEntity;

    public function fetch(EmployeeEntity $company = null);

    public function add(EmployeeEntity $company): EmployeeEntity;

    public function update(EmployeeEntity $company): EmployeeEntity;

    public function remove(EmployeeEntity $company): EmployeeEntity;
}