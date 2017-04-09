<?php
namespace SmartPHP\Interfaces;

interface DataSourceRequestInterface
{

    public function isTransaction(): bool;
    
    public function getData(): array;

    public function setData(array $data): DataSourceRequestInterface;
}