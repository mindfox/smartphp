<?php
namespace SmartPHP\Services\Tests;

use PHPUnit\Framework\TestCase;
use SmartPHP\DefaultImpl\DSOperationFactory;
use SmartPHP\Interfaces\DSOperationInterface;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

class DSOperationFactoryTest extends TestCase
{
    public function testCreateFromArray()
    {
        $array = [];
        $operationFactory = new DSOperationFactory(new GetSetMethodNormalizer());
        $operation = $operationFactory->createDSOperationFromArray($array);
        
        $this->assertInstanceOf(DSOperationInterface::class, $operation);
    }
}
