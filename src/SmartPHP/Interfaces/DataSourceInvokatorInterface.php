<?php
namespace SmartPHP\Interfaces;

interface DataSourceInvokatorInterface
{
    public function invokeDataSource(DataSourceInterface $service, DataSourceMessageInterface $message): DataSourceMessageInterface;
}