<?php
namespace SmartPHP\Collections;

use IteratorAggregate;

abstract class Iterables
{
    public static function append(IteratorAggregate $iterable1, IteratorAggregate $iterable2): IteratorAggregate
    {
        return new Iterable(Iterators::append($iterable1->getIterator(), $iterable2->getIterator()));
    }
}
