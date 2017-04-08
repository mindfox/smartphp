<?php
namespace SmartPHP\Interfaces;

interface DataSourceResponseSerializerInterface
{

    public function serializeResponse(DataSourceResponseInterface $response, string $format): string;

    public function serializeResponses(DataSourceResponsesInterface $responses, string $format): string;
}