<?php
namespace maxmeffert\smartphp;

use Symfony\Component\Serializer\SerializerInterface;
use Psr\Http\Message\ResponseInterface;

class DataSourceResponse extends AbstractResponseInterfaceAdapter
{

    /**
     *
     * @var SerializerInterface
     */
    private $serializer;

    /**
     *
     * @var DataSourceResponseModelWrapper
     */
    private $response;

    public function __construct(ResponseInterface $psrResponse, SerializerInterface $serializer, DataSourceResponseModelWrapper $response = null)
    {
        parent::__construct($psrResponse);
        $this->serializer = $serializer;
        $this->response = $response ?? new DataSourceResponseModelWrapper();
    }

    protected function createImmutable(ResponseInterface $psrResponse): ResponseInterface
    {
        return new self($psrResponse, $this->serializer, $this->response);
    }

    public function serialize($format): self
    {
        $string = $this->serializer->serialize($this->response, $format);
        $this->getBody()->write($string);
        return $this;
    }

    public function getData()
    {
        return $this->response->getData();
    }

    public function setData($data): self
    {
        $this->response->setData($data);
        return $this;
    }
}