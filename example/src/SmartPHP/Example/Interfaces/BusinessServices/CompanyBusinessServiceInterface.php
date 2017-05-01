<?php
namespace SmartPHP\Example\Interfaces\BusinessServices;

use SmartPHP\Example\Models\BusinessModels\CompanyBusinessModel;
use Sabertooth\IteratorStreams\IteratorStreamInterface;

interface CompanyBusinessServiceInterface
{
    public function fetchAll(): IteratorStreamInterface;
    
    public function fetchOne(CompanyBusinessModel $company): CompanyBusinessModel;
    
    public function fetch(int $startRow, int $endRow): IteratorStreamInterface;
    
    public function add(CompanyBusinessModel $company): CompanyBusinessModel;
    
    public function update(CompanyBusinessModel $company): CompanyBusinessModel;
    
    public function remove(CompanyBusinessModel $company): CompanyBusinessModel;
}
