<?php
namespace SmartPHP\Models;

use SmartPHP\Interfaces\DataSourceResponseInterface;
use SmartPHP\Interfaces\DataSourceResponsesInterface;

class DataSourceResponses implements DataSourceResponsesInterface
{

    /**
     *
     * @var array
     */
    private $responses = [];

    public function getResponses(): array
    {
        return $this->responses;
    }

    public function addResponse(DataSourceResponseInterface $response): DataSourceResponsesInterface
    {
        $this->responses[] = $response;
        return $this;
    }
}