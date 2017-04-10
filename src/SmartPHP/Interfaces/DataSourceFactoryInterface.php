<?php
namespace SmartPHP\Interfaces;

interface DataSourceFactoryInterface
{

    public function createDataSourceFromOperation(DSOperationInterface $dsOperation): DataSourceInterface;
}
