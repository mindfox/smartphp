<?php
namespace maxmeffert\smartphp;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;

abstract class AbstractResponseInterfaceAdapter implements ResponseInterface
{
    abstract protected function createImmutable(ResponseInterface $psrResponse): ResponseInterface;
    
    /**
     * The response
     *
     * @var ResponseInterface
     */
    private $psrResponse;

    /**
     * Constructor
     *
     * @param ResponseInterface $psrResponse            
     */
    public function __construct(ResponseInterface $psrResponse)
    {
        $this->psrResponse = $psrResponse;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\MessageInterface::getBody()
     */
    public function getBody()
    {
        return $this->psrResponse->getBody();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\ResponseInterface::getStatusCode()
     */
    public function getStatusCode()
    {
        return $this->psrResponse->getStatusCode();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\ResponseInterface::withStatus()
     */
    public function withStatus($code, $reasonPhrase = '')
    {
        return $this->createImmutable($this->psrResponse->withStatus($code, $reasonPhrase));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\ResponseInterface::getReasonPhrase()
     */
    public function getReasonPhrase()
    {
        return $this->psrResponse->getReasonPhrase();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\MessageInterface::getProtocolVersion()
     */
    public function getProtocolVersion()
    {
        return $this->psrResponse->getProtocolVersion();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\MessageInterface::withProtocolVersion()
     */
    public function withProtocolVersion($version)
    {
        return $this->createImmutable($this->psrResponse->withProtocolVersion($version));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\MessageInterface::getHeaders()
     */
    public function getHeaders()
    {
        return $this->psrResponse->getHeaders();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\MessageInterface::hasHeader()
     */
    public function hasHeader($name)
    {
        return $this->psrResponse->hasHeader($name);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\MessageInterface::getHeader()
     */
    public function getHeader($name)
    {
        return $this->psrResponse->getHeader($name);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\MessageInterface::getHeaderLine()
     */
    public function getHeaderLine($name)
    {
        return $this->psrResponse->getHeaderLine($name);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\MessageInterface::withHeader()
     */
    public function withHeader($name, $value)
    {
        return $this->createImmutable($this->psrResponse->withHeader($name, $value));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\MessageInterface::withAddedHeader()
     */
    public function withAddedHeader($name, $value)
    {
        return $this->createImmutable($this->psrResponse->withAddedHeader($name, $value));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\MessageInterface::withoutHeader()
     */
    public function withoutHeader($name)
    {
        return $this->createImmutable($this->psrResponse->withoutHeader($name));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\MessageInterface::withBody()
     */
    public function withBody(StreamInterface $body)
    {
        return $this->createImmutable($this->psrResponse->withBody($body));
    }
}