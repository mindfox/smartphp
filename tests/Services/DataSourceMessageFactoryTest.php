<?php
namespace SmartPHP\Tests\Services;

use PHPUnit\Framework\TestCase;
use SmartPHP\Interfaces\DataSourceMessageInterface;
use SmartPHP\Services\DataSourceMessageFactory;

class DataSourceMessageFactoryTest extends TestCase
{
    public function testCreateFromArray()
    {
        $array = [];
        $messageFactor = new DataSourceMessageFactory();
        $message = $messageFactor->createFromArray($array);
        
        $this->assertInstanceOf(DataSourceMessageInterface::class, $message);
        
    }
}