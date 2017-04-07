<?php
namespace SmartPHP\Interfaces;



interface DataSourceOperationFactoryInterface
{

    public function createFromDSRequest(DataSourceRequestInterface $request): DataSourceOperationInterface;
}