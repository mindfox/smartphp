<?php
namespace SmartPHP\Example\Interfaces\BusinessServices;

use SmartPHP\Example\Models\BusinessModels\EmployeeBusinessModel;
use SmartPHP\Collections\IteratorStreamInterface;

interface EmployeeBusinessServiceInterface
{
    public function fetchAll(): IteratorStreamInterface;
    
    public function fetchOne(EmployeeBusinessModel $employee): EmployeeBusinessModel;
    
    public function fetch(int $startRow, int $endRow): IteratorStreamInterface;
    
    public function add(EmployeeBusinessModel $employee): EmployeeBusinessModel;
    
    public function update(EmployeeBusinessModel $employee): EmployeeBusinessModel;
    
    public function remove(EmployeeBusinessModel $employee): EmployeeBusinessModel;
}
