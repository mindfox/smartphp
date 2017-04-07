<?php
namespace SmartPHP\Models;

use SmartPHP\Interfaces\DataSourceTransactionInterface;

class DataSourceTransaction implements DataSourceTransactionInterface
{

    private $transactionNum;

    private $operations = [];

    public function getTransactionNum(): int
    {
        return $this->transactionNum;
    }

    public function setTransactionNum(int $transactionNum): DataSourceTransactionInterface
    {
        $this->transactionNum = $transactionNum;
        return $this;
    }

    public function getOperations(): array
    {
        return $this->operations;
    }

    public function addOperation(DataSourceOperation $operation): DataSourceTransactionInterface
    {
        $this->operations[] = $operation;
        return $this;
    }
}