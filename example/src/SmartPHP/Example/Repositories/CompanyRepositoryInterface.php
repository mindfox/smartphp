<?php
namespace SmartPHP\Example\Repositories;

use SmartPHP\Example\Models\Entities\CompanyEntity;

interface CompanyRepositoryInterface
{

    public function fetchAll(): array;

    public function fetchOne(CompanyEntity $company): CompanyEntity;

    public function fetch(CompanyEntity $company = null);

    public function add(CompanyEntity $company): CompanyEntity;

    public function update(CompanyEntity $company): CompanyEntity;

    public function remove(CompanyEntity $company): CompanyEntity;
}
