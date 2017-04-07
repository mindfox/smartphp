<?php
namespace SmartPHP\Models;

use SmartPHP\Interfaces\DataSourceOperationInterface;
use SmartPHP\Interfaces\DataSourceResponseInterface;

class DataSourceResponse implements DataSourceResponseInterface
{

    /**
     *
     * @var DataSourceOperationInterface
     */
    private $response;

    public function getResponse(): DataSourceOperationInterface
    {
        return $this->response;
    }

    public function setResponse(DataSourceOperationInterface $response): DataSourceResponseInterface
    {
        $this->response = $response;
        return $this;
    }
}