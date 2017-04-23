<?php
namespace SmartPHP\Collections;

use \Iterator;

abstract class IteratorCollectors
{

    public static function newCollector(callable $callback): IteratorCollectorInterface
    {
        return new CallbackIteratorCollector($callback);
    }

    public static function toArrayCollection(): IteratorCollectorInterface
    {
        return self::newCollector(function (Iterator $iterator) {
            return new ArrayCollection(iterator_to_array($iterator));
        });
    }
}
