<?php
namespace SmartPHP\DefaultImpl;

use SmartPHP\Interfaces\DataSourceResponseInterface;
use SmartPHP\Interfaces\DataSourceResponsesInterface;

class DataSourceResponses implements DataSourceResponsesInterface
{

    /**
     *
     * @var array
     */
    private $response = [];

    public function getResponses(): array
    {
        return $this->response;
    }

    public function addResponse(DataSourceResponseInterface $response): DataSourceResponsesInterface
    {
        $this->response[] = $response;
        return $this;
    }
}