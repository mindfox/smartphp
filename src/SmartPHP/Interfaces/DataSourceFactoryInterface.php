<?php
namespace SmartPHP\Interfaces;

interface DataSourceFactoryInterface
{

    public function register(string $id, string $dataSoruceServiceClass, string $dataSourceModelClass);

    public function createDataSourceFromId(string $id): DataSourceInterface;

    public function createDataSourceFromOperation(DSOperationInterface $dsOperation): DataSourceInterface;
}
