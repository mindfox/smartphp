<?php
namespace SmartPHP\DefaultImpl;

use SmartPHP\Interfaces\DSOperationResponseInterface;
use SmartPHP\Interfaces\DSOperationInterface;

class DSOperationResponse implements DSOperationResponseInterface
{

    /**
     *
     * @var DataSourceOperationInterface
     */
    private $response;

    public function getResponse(): DSOperationInterface
    {
        return $this->response;
    }

    public function setResponse(DSOperationInterface $response): DSOperationResponseInterface
    {
        $this->response = $response;
        return $this;
    }
}
