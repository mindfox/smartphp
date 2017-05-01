<?php
namespace SmartPHP\Example\Interfaces\BusinessServices;

use SmartPHP\Example\Models\BusinessModels\DepartmentBusinessModel;
use Sabertooth\IteratorStreams\IteratorStreamInterface;

interface DepartmentBusinessServiceInterface
{
    public function fetchAll(): IteratorStreamInterface;
    
    public function fetchOne(DepartmentBusinessModel $department): DepartmentBusinessModel;
    
    public function fetch(int $startRow, int $endRow): IteratorStreamInterface;
    
    public function add(DepartmentBusinessModel $department): DepartmentBusinessModel;
    
    public function update(DepartmentBusinessModel $department): DepartmentBusinessModel;
    
    public function remove(DepartmentBusinessModel $department): DepartmentBusinessModel;
}
