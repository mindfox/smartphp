<?php
namespace SmartPHP\Interfaces;

interface DSTransactionInterface
{

    public function getTransactionNum(): int;

    public function setTransactionNum(int $transactionNum): DSTransactionInterface;

    public function getOperations(): array;

    public function addOperation(DSOperationInterface $dsOperation): DSTransactionInterface;
}