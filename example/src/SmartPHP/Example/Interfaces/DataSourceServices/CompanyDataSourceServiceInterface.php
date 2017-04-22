<?php
namespace SmartPHP\Example\Interfaces\DataSourceServices;

use SmartPHP\Example\Models\DataSourceModels\CompanyDataSourceModel;

interface CompanyDataSourceServiceInterface
{

    public function fetchAll(): array;

    public function fetchOne(CompanyDataSourceModel $company): CompanyDataSourceModel;

    public function fetch(int $startRow, int $endRow): array;

    public function add(CompanyDataSourceModel $company): CompanyDataSourceModel;

    public function update(CompanyDataSourceModel $company): CompanyDataSourceModel;

    public function remove(CompanyDataSourceModel $company): CompanyDataSourceModel;
}
