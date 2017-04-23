<?php
namespace SmartPHP\Collections\Tests;

use PHPUnit\Framework\TestCase;
use SmartPHP\Collections\ArrayCollection;

class ArrayCollectionTest extends TestCase
{

    private static $elements = [
        1,
        2,
        3,
        4,
        5
    ];

    private static $element = 42;

    public function testConstruct()
    {
        $collection = new ArrayCollection(self::$elements);
        $this->assertAttributeEquals(self::$elements, "elements", $collection);
    }

    public function testIsIterable()
    {
        $collection = new ArrayCollection(self::$elements);
        foreach ($collection as $key => $element) {
            $this->assertEquals(self::$elements[$key], $element);
        }
    }

    public function testAdd()
    {
        $collection = new ArrayCollection();
        $collection->add(self::$element);
        $this->assertAttributeContains(self::$element, "elements", $collection);
    }
}
