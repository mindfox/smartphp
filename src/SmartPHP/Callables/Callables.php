<?php
namespace SmartPHP\Callables;

abstract class Callables
{

    public static function newPredicate(callable $predicate): PredicateInterface
    {
        return new Predicate($predicate);
    }

    public static function newComparator(callable $comparator): ComparatorInterface
    {
        return new Comparator($comparator);
    }
}
