<?php
namespace SmartPHP\DefaultImpl;

use Symfony\Component\Serializer\SerializerInterface;
use SmartPHP\Interfaces\DSResponseSerializerInterface;
use SmartPHP\Interfaces\DSResponseInterface;
use SmartPHP\Interfaces\DSTransactionResponseInterface;
use SmartPHP\Interfaces\DSOperationResponseInterface;

class DSResponseSerializer implements DSResponseSerializerInterface
{

    const FORMAT_JSON = "json";

    const RESTDATASOURCE_JSON_PREFIX = "<SCRIPT>//'\"]]>>isc_JSONResponseStart>>";

    const RESTDATASOURCE_JSON_SUFFIX = "//isc_JSONResponseEnd";

    /**
     *
     * @var SerializerInterface
     */
    private $serializer;

    /**
     *
     * @var string
     */
    private $jsonPrefix;

    /**
     *
     * @var string
     */
    private $jsonSuffix;

    public function __construct(SerializerInterface $serializer, $jsonPrefix = self::RESTDATASOURCE_JSON_PREFIX, $jsonSuffix = self::RESTDATASOURCE_JSON_SUFFIX)
    {
        $this->serializer = $serializer;
        $this->jsonPrefix = $jsonPrefix;
        $this->jsonSuffix = $jsonSuffix;
    }

    private function prependJsonPrefix(string $string): string
    {
        return $this->jsonPrefix . $string;
    }

    private function appendJsonSuffix(string $string): string
    {
        return $string . $this->jsonSuffix;
    }

    private function normalizeJsonTransactionResponse(string $string): string
    {
        return $this->prependJsonPrefix($this->appendJsonSuffix($string));
    }

    private function normalizeTransactionResponse(string $string, string $format): string
    {
        switch (strtolower($format)) {
            case self::FORMAT_JSON:
                $string = $this->normalizeJsonTransactionResponse($string);
                break;
        }
        return $string;
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
        
        throw new \Exception("DSResponse type '" . get_class($dsResponse) . "' is not supported!");
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
        return $this->normalizeTransactionResponse($serialized ?? "", $format);
    }
}
