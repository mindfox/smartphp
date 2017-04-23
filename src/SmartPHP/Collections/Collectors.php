<?php
namespace SmartPHP\Collections;

use \Iterator;
use SmartPHP\Collections\Iterators\Collectors\CollectorInterface;
use SmartPHP\Collections\Iterators\Collectors\CallbackCollector;

abstract class Collectors
{
    public static function newCollector(callable $callback): CollectorInterface
    {
        return new CallbackCollector($callback);
    }
    
    public static function toArray(): CollectorInterface
    {
        return self::newCollector(function (Iterator $iterator) {
            return iterator_to_array($iterator);
        });
    }
    
    public static function toArrayCollection(): CollectorInterface
    {
        return self::newCollector(function (Iterator $iterator) {
            return new ArrayCollection(iterator_to_array($iterator));
        });
    }
}
