<?php
namespace intrawarez\smartphp\psr;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;

abstract class MessageInterfaceAdapter implements MessageInterface
{  
    /**
     * @var MessageInterface
     */
    private $adaptedMessage;
    
    public function __construct(MessageInterface $message)
    {
        $this->adaptedMessage = $message;
    }
    
    public function getProtocolVersion()
    {
        return $this->adaptedMessage->getProtocolVersion();
    }
    
    public function withProtocolVersion($version)
    {
        return $this->adaptedMessage->withProtocolVersion($version);
    }
    
    public function  getHeaders()
    {
        return $this->adaptedMessage->getHeaders();
    }
    
    public function hasHeader($name)
    {
        return $this->adaptedMessage->hasHeader($name);
    }
    
    public function getHeader($name)
    {
        return $this->adaptedMessage->getHeader($name);
    }
    
    public function getHeaderLine($name)
    {
        return $this->adaptedMessage->getHeaderLine($name);
    }
    
    public function withHeader($name, $value)
    {
        return $this->adaptedMessage->withHeader($name, $value);
    }
    
    public function withAddedHeader($name, $value)
    {
        return $this->adaptedMessage->withAddedHeader($name, $value);
    }
    
    public function withoutHeader($name)
    {
        return $this->adaptedMessage->withoutHeader($name);
    }
    
    public function getBody()
    {
        return $this->adaptedMessage->getBody();
    }
    
    public function withBody(StreamInterface $body)
    {
        return $this->adaptedMessage->withBody($body);
    }
}