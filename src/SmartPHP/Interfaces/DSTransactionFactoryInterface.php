<?php
namespace SmartPHP\Interfaces;

interface DSTransactionFactoryInterface
{

    public function createDSTransactionFromArray(array $array): DSTransactionInterface;

    public function createDSTransactionFromDSRequest(DSRequestInterface $dsRequest): DSTransactionInterface;
}
