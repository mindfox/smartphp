<?php
namespace SmartPHP\Interfaces;

interface DSTransactionFactoryInterface
{

    public function createFromArray(array $array): DSTransactionFactoryInterface;

    public function createFromDSRequest(DSRequestInterface $dsRequest): DSTransactionFactoryInterface;
}