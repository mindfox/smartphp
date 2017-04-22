<?php
namespace SmartPHP\Example\Repositories;

use SmartPHP\Example\Models\Entities\CompanyEntity;

interface CompanyRepositoryInterface
{

    public function fetchAll(): array;

    public function fetchOne(CompanyEntity $company): CompanyEntity;

    public function fetch(int $startRow, int $endRow): array;

    public function add(CompanyEntity $company): CompanyEntity;

    public function update(CompanyEntity $company): CompanyEntity;

    public function remove(CompanyEntity $company): CompanyEntity;
}
