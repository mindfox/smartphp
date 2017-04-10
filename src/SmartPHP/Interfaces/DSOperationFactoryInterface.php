<?php
namespace SmartPHP\Interfaces;

interface DSOperationFactoryInterface
{

    public function createFromArray(array $array): DSOperationInterface;

    public function createFromDSRequest(DSRequestInterface $dsRequest): DSOperationInterface;
}
