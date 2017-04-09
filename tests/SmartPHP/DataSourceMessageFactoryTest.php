<?php
namespace SmartPHP\Services\Tests;

use PHPUnit\Framework\TestCase;
use SmartPHP\DefaultImpl\DataSourceOperationFactory;
use SmartPHP\Interfaces\DataSourceOperationInterface;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

class DataSourceMessageFactoryTest extends TestCase
{
    public function testCreateFromArray()
    {
        $array = [];
        $operationFactory = new DataSourceOperationFactory(new GetSetMethodNormalizer());
        $operation = $operationFactory->createFromArray($array);
        
        $this->assertInstanceOf(DataSourceOperationInterface::class, $operation);
        
    }
}