<?php
namespace SmartPHP\Interfaces;

interface DataSourceFactoryInterface
{

    public function createFromDataSourceMessage(DataSourceMessageInterface $message): DataSourceInterface;
}