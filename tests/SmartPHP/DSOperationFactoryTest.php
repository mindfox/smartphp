<?php
namespace SmartPHP\Services\Tests;

use PHPUnit\Framework\TestCase;
use SmartPHP\DefaultImpl\DataSourceOperationFactory;
use SmartPHP\Interfaces\DSOperationInterface;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

class DSOperationFactoryTest extends TestCase
{
    public function testCreateFromArray()
    {
        $array = [];
        $operationFactory = new DataSourceOperationFactory(new GetSetMethodNormalizer());
        $operation = $operationFactory->createFromArray($array);
        
        $this->assertInstanceOf(DSOperationInterface::class, $operation);
        
    }
}