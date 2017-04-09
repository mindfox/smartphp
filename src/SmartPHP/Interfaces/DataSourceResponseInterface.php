<?php
namespace SmartPHP\Interfaces;

interface DataSourceResponseInterface
{

    public function getResponse(): DataSourceOperationInterface;

    public function setResponse(DataSourceOperationInterface $response): DataSourceResponseInterface;
}