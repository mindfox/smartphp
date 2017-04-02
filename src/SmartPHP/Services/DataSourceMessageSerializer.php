<?php
namespace SmartPHP\Services;

use Symfony\Component\Serializer\SerializerInterface;
use SmartPHP\Interfaces\DataSourceMessageSerializerInterface;
use SmartPHP\Interfaces\DataSourceMessageInterface;

class DataSourceMessageSerializer implements DataSourceMessageSerializerInterface
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
     * @see \SmartPHP\DataSourceMessageSerializerInterface::serialize()
     */
    public function serialize(DataSourceMessageInterface $message): string
    {
        $data = [
            "response" => $message
        ];
        $format = $message->getDataFormat();
        $serialized = $this->serializer->serialize($data, $format);
        return $serialized ?? "";
    }
}