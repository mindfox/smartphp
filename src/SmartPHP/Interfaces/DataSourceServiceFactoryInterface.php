<?php
namespace SmartPHP\Interfaces;

interface DataSourceServiceFactoryInterface
{

    public function createFromDataSourceMessage(DataSourceMessageInterface $message): DataSourceServiceInterface;
}