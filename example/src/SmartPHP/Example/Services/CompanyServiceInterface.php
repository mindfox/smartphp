<?php
namespace SmartPHP\Example\Services;

use SmartPHP\Example\Models\DataSourceModels\CompanyDataSourceModel;

interface CompanyServiceInterface
{

    public function fetchAll(): array;

    public function fetchOne(CompanyDataSourceModel $company): CompanyDataSourceModel;

    public function fetch(int $startRow, int $endRow): array;

    public function add(CompanyDataSourceModel $company): CompanyDataSourceModel;

    public function update(CompanyDataSourceModel $company): CompanyDataSourceModel;

    public function remove(CompanyDataSourceModel $company): CompanyDataSourceModel;
}
