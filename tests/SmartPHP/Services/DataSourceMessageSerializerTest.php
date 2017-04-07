<?php
namespace SmartPHP\Services\Tests;

use Phake;
use PHPUnit\Framework\TestCase;
use SmartPHP\Interfaces\DataSourceOperationInterface;
use Symfony\Component\Serializer\SerializerInterface;
use SmartPHP\Services\DataSourceMessageSerializer;

class DataSourceMessageSerializerTest extends TestCase
{
    public function testSerializeMessage()
    {
        $message = Phake::mock(DataSourceMessageInterface::class);
        $serializer = Phake::mock(SerializerInterface::class);
        
        $messageSerializer = new DataSourceMessageSerializer($serializer);
        $messageSerializer->serialize($message);
                
        Phake::verify($message)->getDataFormat();
        Phake::verify($serializer)->serialize([ "response" => $message ], "");
    }
}