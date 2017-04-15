<?php
namespace SmartPHP\Interfaces;

interface DataSourceModelConverterFactoryInterface
{
    public function createDataSourceModelConverter(string $dataSourceModelClass): DataSourceModelConverterInterface;
}
