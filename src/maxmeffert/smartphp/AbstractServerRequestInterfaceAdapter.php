<?php
namespace maxmeffert\smartphp;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;

abstract class AbstractServerRequestInterfaceAdapter implements ServerRequestInterface
{

    abstract protected function createImmutable(ServerRequestInterface $psrServerRequest): ServerRequestInterface;

    /**
     *
     * @var ServerRequestInterface
     */
    private $psrServerRequest;

    public function __construct(ServerRequestInterface $psrServerRequest)
    {
        $this->psrServerRequest = $psrServerRequest;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\MessageInterface::getBody()
     */
    public function getBody()
    {
        return $this->psrServerRequest->getBody();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\ServerRequestInterface::getServerParams()
     */
    public function getServerParams()
    {
        return $this->psrServerRequest->getServerParams();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\ServerRequestInterface::getCookieParams()
     */
    public function getCookieParams()
    {
        return $this->psrServerRequest->getCookieParams();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\ServerRequestInterface::withCookieParams()
     */
    public function withCookieParams(array $cookies)
    {
        return $this->createImmutable($this->withCookieParams($cookies));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\ServerRequestInterface::getQueryParams()
     */
    public function getQueryParams()
    {
        return $this->psrServerRequest->getQueryParams();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\ServerRequestInterface::withQueryParams()
     */
    public function withQueryParams(array $query)
    {
        return $this->createImmutable($this->psrServerRequest->withQueryParams($query));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\ServerRequestInterface::getUploadedFiles()
     */
    public function getUploadedFiles()
    {
        return $this->psrServerRequest->getUploadedFiles();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\ServerRequestInterface::withUploadedFiles()
     */
    public function withUploadedFiles(array $uploadedFiles)
    {
        return $this->createImmutable($this->psrServerRequest->withUploadedFiles($uploadedFiles));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\ServerRequestInterface::getParsedBody()
     */
    public function getParsedBody()
    {
        return $this->psrServerRequest->getParsedBody();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\ServerRequestInterface::withParsedBody()
     */
    public function withParsedBody($data)
    {
        return $this->createImmutable($this->psrServerRequest->withParsedBody($data));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\ServerRequestInterface::getAttributes()
     */
    public function getAttributes()
    {
        return $this->psrServerRequest->getAttributes();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\ServerRequestInterface::getAttribute()
     */
    public function getAttribute($name, $default = null)
    {
        return $this->psrServerRequest->getAttribute($name, $default);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\ServerRequestInterface::withAttribute()
     */
    public function withAttribute($name, $value)
    {
        return $this->createImmutable($this->psrServerRequest->withAttribute($name, $value));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\ServerRequestInterface::withoutAttribute()
     */
    public function withoutAttribute($name)
    {
        return $this->createImmutable($this->psrServerRequest->withoutAttribute($name));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\RequestInterface::getRequestTarget()
     */
    public function getRequestTarget()
    {
        return $this->psrServerRequest->getRequestTarget();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\RequestInterface::withRequestTarget()
     */
    public function withRequestTarget($requestTarget)
    {
        return $this->createImmutable($this->psrServerRequest->withRequestTarget($requestTarget));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\RequestInterface::getMethod()
     */
    public function getMethod()
    {
        return $this->psrServerRequest->getMethod();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\RequestInterface::withMethod()
     */
    public function withMethod($method)
    {
        return $this->createImmutable($this->psrServerRequest->withMethod($method));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\RequestInterface::getUri()
     */
    public function getUri()
    {
        return $this->psrServerRequest->getUri();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\RequestInterface::withUri()
     */
    public function withUri(UriInterface $uri, $preserveHost = false)
    {
        return $this->createImmutable($this->psrServerRequest->withUri($uri, $preserveHost));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\MessageInterface::getProtocolVersion()
     */
    public function getProtocolVersion()
    {
        return $this->psrServerRequest->getProtocolVersion();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\MessageInterface::withProtocolVersion()
     */
    public function withProtocolVersion($version)
    {
        return $this->createImmutable($this->psrServerRequest->withProtocolVersion($version));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\MessageInterface::getHeaders()
     */
    public function getHeaders()
    {
        return $this->psrServerRequest->getHeaders();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\MessageInterface::hasHeader()
     */
    public function hasHeader($name)
    {
        return $this->psrServerRequest->hasHeader($name);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\MessageInterface::getHeader()
     */
    public function getHeader($name)
    {
        return $this->psrServerRequest->getHeader($name);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\MessageInterface::getHeaderLine()
     */
    public function getHeaderLine($name)
    {
        return $this->psrServerRequest->getHeaderLine($name);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\MessageInterface::withHeader()
     */
    public function withHeader($name, $value)
    {
        return $this->createImmutable($this->psrServerRequest->withHeader($name, $value));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\MessageInterface::withAddedHeader()
     */
    public function withAddedHeader($name, $value)
    {
        return $this->createImmutable($this->psrServerRequest->withAddedHeader($name, $value));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\MessageInterface::withoutHeader()
     */
    public function withoutHeader($name)
    {
        return $this->createImmutable($this->psrServerRequest->withoutHeader($name));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Psr\Http\Message\MessageInterface::withBody()
     */
    public function withBody(StreamInterface $body)
    {
        return $this->createImmutable($this->psrServerRequest->withBody($body));
    }
}