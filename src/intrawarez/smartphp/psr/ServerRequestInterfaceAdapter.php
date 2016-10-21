<?php
namespace intrawarez\smartphp\psr;

use Psr\Http\Message\ServerRequestInterface;

abstract class ServerRequestInterfaceAdapter extends RequestInterfaceAdapter implements ServerRequestInterface
{
    /**
     * @var ServerRequestInterface
     */
    private $adaptedRequest;

    public function __construct(ServerRequestInterface $request)
    {
        parent::__construct($request);
        $this->adaptedRequest = $request;
    }

    public function getServerParams()
    {
        return $this->adaptedRequest->getServerParams();
    }

    public function getCookieParams()
    {
        return $this->adaptedRequest->getCookieParams();
    }

    public function withCookieParams(array $cookies)
    {
        return $this->adaptedRequest->withCookieParams($cookies);
    }

    public function getQueryParams()
    {
        return $this->adaptedRequest->getQueryParams();
    }
    
    public function withQueryParams(array $query)
    {
        return $this->adaptedRequest->withQueryParams($query);
    }
    
    public function getUploadedFiles()
    {
        return $this->adaptedRequest->getUploadedFiles();
    }
    
    public function withUploadedFiles(array $uploadedFiles)
    {
        return $this->adaptedRequest->withUploadedFiles($uploadedFiles);
    }
    
    public function getParsedBody()
    {
        return $this->adaptedRequest->getParsedBody();
    }
    
    public function withParsedBody($data)
    {
        return $this->adaptedRequest->withParsedBody($data);
    }
    
    public function getAttributes()
    {
        return $this->adaptedRequest->getAttributes();
    }
    
    public function getAttribute($name, $default = null)
    {
        return $this->adaptedRequest->getAttribute($name, $default);
    }
    
    public function withAttribute($name, $value)
    {
        return $this->adaptedRequest->withAttribute($name, $value);
    }
    
    public function withoutAttribute($name)
    {
        return $this->adaptedRequest->withoutAttribute($name);
    }
}