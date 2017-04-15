<?php
namespace SmartPHP\Interfaces;

interface DSOperationFactoryInterface
{

    public function createDSOperationFromArray(array $array): DSOperationInterface;

    public function createDSOperationFromDSRequest(DSRequestInterface $dsRequest): DSOperationInterface;
}
