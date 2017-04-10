<?php
namespace SmartPHP\Interfaces;

interface DSRequestInterface
{

    public function isTransaction(): bool;
    
    public function getData(): array;

    public function setData(array $data): DSRequestInterface;
}
