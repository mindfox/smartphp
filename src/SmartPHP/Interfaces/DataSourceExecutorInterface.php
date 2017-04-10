<?php
namespace SmartPHP\Interfaces;

interface DataSourceExecutorInterface
{

    public function executeOperation(DSOperationInterface $operation): DSResponseInterface;

    public function executeTransaction(DSTransactionInterface $transaction): DSResponseInterface;
}
