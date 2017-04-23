<?php
namespace SmartPHP\Collections\Tests;

use PHPUnit\Framework\TestCase;
use SmartPHP\Collections\Iterators;
use SmartPHP\Collections\OptionalInterface;

class IteratorsTest extends TestCase
{

    private static $array = [
        1,
        2,
        3,
        4,
        5,
        6
    ];

    public function testFromArray()
    {
        $iterator = Iterators::fromArray(self::$array);
        $this->assertInstanceOf(\Iterator::class, $iterator);
        $this->assertInstanceOf(\ArrayIterator::class, $iterator);
        foreach ($iterator as $key => $val) {
            $this->assertEquals(self::$array[$key], $val);
        }
    }

    public function testToArray()
    {
        $array = Iterators::toArray(Iterators::fromArray(self::$array));
        $this->assertEquals(self::$array, $array);
    }

    public function testMax()
    {
        $iterator = Iterators::fromArray(self::$array);
        $result = Iterators::max($iterator, function ($a, $b) {
            return $a - $b;
        });
        $this->assertInstanceOf(OptionalInterface::class, $result);
        $this->assertTrue($result->isPesent());
        $this->assertEquals(6, $result->getValue());
    }

    public function testMin()
    {
        $iterator = Iterators::fromArray(self::$array);
        $result = Iterators::min($iterator, function ($a, $b) {
            return $a - $b;
        });
        $this->assertInstanceOf(OptionalInterface::class, $result);
        $this->assertTrue($result->isPesent());
        $this->assertEquals(1, $result->getValue());
    }
}
