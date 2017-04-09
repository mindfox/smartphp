<?php
namespace SmartPHP\Services\Tests;

use Phake;
use PHPUnit\Framework\TestCase;
use SmartPHP\DefaultImpl\DataSourceResponseSerializer;
use SmartPHP\Interfaces\DataSourceResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DataSourceMessageSerializerTest extends TestCase
{
    public function testSerializeMessage()
    {
        $format = "json";
        $response = Phake::mock(DataSourceResponseInterface::class);
        $serializer = Phake::mock(SerializerInterface::class);
        
        $responseSerializer = new DataSourceResponseSerializer($serializer);
        $responseSerializer->serializeResponse($response, $format);
                
        Phake::verify($serializer)->serialize($response, $format);
    }
}