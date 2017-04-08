<?php
namespace SmartPHP\Interfaces;



interface DataSourceOperationFactoryInterface
{

    public function createFromArray(array $array): DataSourceOperationInterface;
    
    public function createFromDSRequest(DataSourceRequestInterface $dsRequest): DataSourceOperationInterface;
}