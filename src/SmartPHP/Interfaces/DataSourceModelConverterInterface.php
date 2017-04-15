<?php
namespace SmartPHP\Interfaces;

interface DataSourceModelConverterInterface
{

    public function toArray(DataSourceModelInterface$dataSourceModel): array;

    public function toModel(array $array): DataSourceModelInterface;
}