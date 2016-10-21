<?php
namespace intrawarez\smartphp\psr;

use Psr\Http\Message\ResponseInterface;

abstract class ResponseInterfaceAdapter extends MessageInterfaceAdapter implements ResponseInterface
{
    /**
     * @var ResponseInterface
     */
    private $adaptedResponse;
    
    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);
        $this->adaptedResponse = $response;
    }
    
    public function getStatusCode()
    {
        return $this->adaptedResponse->getStatusCode();
    }
    
    public function withStatus($code, $reasonPhrase = "")
    {
        return $this->adaptedResponse->withStatus($code, $reasonPhrase);
    }
    
    public function getReasonPhrase()
    {
        return $this->adaptedResponse->getReasonPhrase();
    }
}