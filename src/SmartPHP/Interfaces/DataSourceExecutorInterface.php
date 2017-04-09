<?php
namespace SmartPHP\Interfaces;

interface DataSourceExecutorInterface
{

    public function executeOperation(DataSourceOperationInterface $operation): DataSourceResponseInterface;

    public function executeTransaction(DataSourceTransactionInterface $transaction): DataSourceResponsesInterface;
}