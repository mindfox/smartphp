<?php
namespace SmartPHP\Interfaces;

interface DataSourceFactoryInterface
{

    public function createFromDataSourceMessage(DataSourceOperationInterface $message): DataSourceInterface;
}