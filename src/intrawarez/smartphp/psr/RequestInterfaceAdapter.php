<?php
namespace intrawarez\smartphp\psr;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

abstract class RequestInterfaceAdapter extends MessageInterfaceAdapter implements RequestInterface
{
    /**
     * @var RequestInterface
     */
    private $adaptedRequest;
    
    public function __construct(RequestInterface $request)
    {
        parent::__construct($request);
        $this->adaptedRequest = $request;
    }
    
    public function getRequestTarget()
    {
        return $this->adaptedRequest->getRequestTarget();
    }
    
    public function withRequestTarget($requestTarget)
    {
        return $this->adaptedRequest->withRequestTarget($requestTarget);
    }
    
    public function getMethod()
    {
        return $this->adaptedRequest->getMethod();
    }
    
    public function withMethod($method)
    {
        return $this->adaptedRequest->withMethod($method);
    }
    
    public function getUri()
    {
        return $this->adaptedRequest->getUri();
    }
    
    public function withUri(UriInterface $uri, $preserveHost = false)
    {
        return $this->adaptedRequest->withUri($uri, $preserveHost);
    }
}
