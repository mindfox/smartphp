<?php
namespace SmartPHP\Interfaces;

interface DataSourceExecutorInterface
{

    public function executeOperation(DataSourceInterface $dataSource, DataSourceOperationInterface $operation): DataSourceResponseInterface;

    public function executeTransaction(DataSourceInterface $dataSource, DataSourceTransactionInterface $transaction): DataSourceResponsesInterface;
}