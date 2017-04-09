<?php
namespace SmartPHP\Interfaces;

interface DataSourceTransactionFactoryInterface
{

    public function createFromArray(array $array): DataSourceTransactionInterface;

    public function createFromDSRequest(DataSourceRequestInterface $dsRequest): DataSourceTransactionInterface;
}