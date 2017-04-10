<?php
namespace SmartPHP\DefaultImpl;

use Symfony\Component\Serializer\SerializerInterface;
use SmartPHP\Interfaces\DSResponseSerializerInterface;
use SmartPHP\Interfaces\DSResponseInterface;
use SmartPHP\Interfaces\DSTransactionResponseInterface;
use SmartPHP\Interfaces\DSOperationResponseInterface;

class DataSourceResponseSerializer implements DSResponseSerializerInterface
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
     * @see \SmartPHP\Interfaces\DSResponseSerializerInterface::serializeResponse()
     */
    public function serializeResponse(DSResponseInterface $dsResponse, string $format): string
    {
        if ($dsResponse instanceof DSOperationResponseInterface) {
            return $this->serializeOperationResponse($dsResponse, $format);
        }
        
        if ($dsResponse instanceof DSTransactionResponseInterface) {
            return $this->serializeTransactionResponse($dsResponse, $format);
        }
        
        throw new \Exception("asdf");
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DSResponseSerializerInterface::serializeOperationResponse()
     */
    public function serializeOperationResponse(DSOperationResponseInterface $dsOperationResponse, string $format): string
    {
        $serialized = $this->serializer->serialize($dsOperationResponse, $format);
        return $serialized ?? "";
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DSResponseSerializerInterface::serializeTransactionResponse()
     */
    public function serializeTransactionResponse(DSTransactionResponseInterface $dsTransactionResponse, string $format): string
    {
        $serialized = $this->serializer->serialize($dsTransactionResponse->getResponses(), $format);
        return $serialized ?? "";
    }
}
