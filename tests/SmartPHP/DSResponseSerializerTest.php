<?php
namespace SmartPHP\Services\Tests;

use Phake;
use PHPUnit\Framework\TestCase;
use SmartPHP\DefaultImpl\DSResponseSerializer;
use SmartPHP\Interfaces\DSOperationResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DSResponseSerializerTest extends TestCase
{
    public function testSerializeMessage()
    {
        $format = "json";
        $response = Phake::mock(DSOperationResponseInterface::class);
        $serializer = Phake::mock(SerializerInterface::class);
        
        $responseSerializer = new DSResponseSerializer($serializer);
        $responseSerializer->serializeResponse($response, $format);
                
        Phake::verify($serializer)->serialize($response, $format);
    }
}
