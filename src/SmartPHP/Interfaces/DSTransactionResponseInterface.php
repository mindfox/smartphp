<?php
namespace SmartPHP\Interfaces;

interface DSTransactionResponseInterface extends DSResponseInterface
{

    public function getResponses(): array;

    public function addResponse(DSOperationResponseInterface $dsOperationResponse): DSTransactionResponseInterface;
}
