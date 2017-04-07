<?php
namespace SmartPHP\Interfaces;

use SmartPHP\Models\DataSourceOperation;

interface DataSourceTransactionInterface
{
    public function getTransactionNum(): int;
    
    public function setTransactionNum(int $transactionNum): DataSourceTransactionInterface;
    
    public function getOperations(): array;
    
    public function addOperation(DataSourceOperation $operation): DataSourceTransactionInterface;
}