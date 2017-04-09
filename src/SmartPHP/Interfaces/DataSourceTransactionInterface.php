<?php
namespace SmartPHP\Interfaces;

interface DataSourceTransactionInterface
{

    public function getTransactionNum(): int;

    public function setTransactionNum(int $transactionNum): DataSourceTransactionInterface;

    public function getOperations(): array;

    public function addOperation(DataSourceOperationInterface $operation): DataSourceTransactionInterface;
}