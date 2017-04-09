<?php
namespace SmartPHP\Interfaces;

interface DSResponseSerializerInterface
{

    public function serializeResponse(DSResponseInterface $dsResponse, string $format): string;

    public function serializeOperationResponse(DSOperationResponseInterface $dsOperationResponse, string $format): string;

    public function serializeTransactionResponse(DSTransactionResponseInterface $dsTransactionResponse, string $format): string;
}