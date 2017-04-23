<?php
namespace SmartPHP\Example\Interfaces\BusinessServices;

use Smartphp\example\models\BusinessModels\CompanyBusinessModel;

interface CompanyBusinessServiceInterface
{
    public function fetchAll(): array;
    
    public function fetchOne(CompanyBusinessModel $company): CompanyBusinessModel;
    
    public function fetch(int $startRow, int $endRow): array;
    
    public function add(CompanyBusinessModel $company): CompanyBusinessModel;
    
    public function update(CompanyBusinessModel $company): CompanyBusinessModel;
    
    public function remove(CompanyBusinessModel $company): CompanyBusinessModel;
}
