<?php
namespace SmartPHP\DefaultImpl;

use SmartPHP\Interfaces\DSTransactionResponseInterface;
use SmartPHP\Interfaces\DSOperationResponseInterface;

class DSTransactionResponse implements DSTransactionResponseInterface
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

    public function addResponse(DSOperationResponseInterface $response): DSTransactionResponseInterface
    {
        $this->response[] = $response;
        return $this;
    }
}
