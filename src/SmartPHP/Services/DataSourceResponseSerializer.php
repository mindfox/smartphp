<?php
namespace SmartPHP\Services;

use SmartPHP\Interfaces\DataSourceResponseInterface;
use SmartPHP\Interfaces\DataSourceResponseSerializerInterface;
use SmartPHP\Interfaces\DataSourceResponsesInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DataSourceResponseSerializer implements DataSourceResponseSerializerInterface
{

    /**
     *
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceResponseSerializerInterface::serializeResponse()
     */
    public function serializeResponse(DataSourceResponseInterface $response)
    {
        $format = $response->getDataFormat();
        $serialized = $this->serializer->serialize($response, $format);
        return $serialized ?? "";
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceResponseSerializerInterface::serializeResponses()
     */
    public function serializeResponses(DataSourceResponsesInterface $responses)
    {
        $format = $responses->getDataFormat();
        $serialized = $this->serializer->serialize($responses, $format);
        return $serialized ?? "";
    }
}