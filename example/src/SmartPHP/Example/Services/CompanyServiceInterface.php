<?php
namespace SmartPHP\Example\Services;

use SmartPHP\Example\Models\Dtos\CompanyDto;

interface CompanyServiceInterface
{

    public function fetchAll(): array;

    public function fetchOne(CompanyDto $company): CompanyDto;

    public function fetch(int $startRow, int $endRow): array;

    public function add(CompanyDto $company): CompanyDto;

    public function update(CompanyDto $company): CompanyDto;

    public function remove(CompanyDto $company): CompanyDto;
}
