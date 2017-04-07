<?php
namespace SmartPHP\Services\Tests;

use PHPUnit\Framework\TestCase;
use SmartPHP\Interfaces\DataSourceOperationInterface;
use SmartPHP\Services\DataSourceMessageFactory;

class DataSourceMessageFactoryTest extends TestCase
{
    public function testCreateFromArray()
    {
        $array = [];
        $messageFactor = new DataSourceMessageFactory();
        $message = $messageFactor->createFromArray($array);
        
        $this->assertInstanceOf(DataSourceOperationInterface::class, $message);
        
    }
}