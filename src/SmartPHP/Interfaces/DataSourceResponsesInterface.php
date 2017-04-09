<?php
namespace SmartPHP\Interfaces;

interface DataSourceResponsesInterface
{

    public function getResponses(): array;

    public function addResponse(DataSourceResponseInterface $response): DataSourceResponsesInterface;
}