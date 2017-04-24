<?php
namespace SmartPHP\Example\Interfaces\Repositories;

use SmartPHP\Collections\IteratorStreamInterface;
use SmartPHP\Example\Models\DoctrineEntities\CompanyEntity;

interface CompanyRepositoryInterface
{

    public function fetchAll(): IteratorStreamInterface;

    public function fetchOne(CompanyEntity $company): CompanyEntity;

    public function fetch(int $startRow, int $endRow): IteratorStreamInterface;

    public function add(CompanyEntity $company): CompanyEntity;

    public function update(CompanyEntity $company): CompanyEntity;

    public function remove(CompanyEntity $company): CompanyEntity;
}
