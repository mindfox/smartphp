<?php
namespace SmartPHP\Collections;

use SmartPHP\Callables\Callables;
use SmartPHP\Callables\PredicateInterface;
use SmartPHP\Callables\ComparatorInterface;

abstract class Arrays
{

    private static function allWithPredicate(array $array, PredicateInterface $predicate): bool
    {
        foreach ($array as $value) {
            if ($predicate->accept($value)) {
                return false;
            }
        }
        return true;
    }

    public static function all(array $array, callable $predicate): bool
    {
        return static::allWithPredicate($array, Callables::newPredicate($predicate));
    }

    private static function someWithPredicate(array $array, PredicateInterface $predicate): bool
    {
        foreach ($array as $value) {
            if ($predicate->accept($value)) {
                return true;
            }
        }
        return false;
    }

    public static function some(array $array, callable $predicate): bool
    {
        return static::someWithPredicate($array, Callables::newPredicate($predicate));
    }

    public static function none(array $array, callable $predicate): bool
    {
        return ! static::all($array, $predicate);
    }

    private static function maxWithComparator(array $array, ComparatorInterface $comparator): OptionalInterface
    {
        $count = count($array);
        if ($count > 0) {
            $max = $array[0];
            for ($i = 1; $i < $count; $i ++) {
                if ($comparator->greaterThan($array[$i], $max)) {
                    $max = $array[$i];
                }
            }
            return Optional::of($max);
        }
        return Optional::absent();
    }

    public static function max(array $array, callable $comparator): OptionalInterface
    {
        return static::maxWithComparator($array, Callables::newComparator($comparator));
    }

    private static function minWithComparator(array $array, ComparatorInterface $comparator): OptionalInterface
    {
        $count = count($array);
        if ($count > 0) {
            $min = $array[0];
            for ($i = 1; $i < $count; $i ++) {
                if ($comparator->lessThan($array[$i], $min)) {
                    $min = $array[$i];
                }
            }
            return Optional::of($min);
        }
        return Optional::absent();
    }

    public static function min(array $array, callable $comparator): OptionalInterface
    {
        return static::minWithComparator($array, Callables::newComparator($comparator));
    }

    public static function count(array $array): int
    {
        return count($array);
    }

    public static function isEmpty(array $array): bool
    {
        return static::count($array) === 0;
    }

    public static function filter(array $array, callable $predicate): array
    {
        return array_filter($array, $predicate);
    }

    public static function map(array $array, callable $functor): array
    {
        return array_map($functor, $array);
    }
    
    public static function reduce(array $array, $initial, callable $aggregator)
    {
        return array_reduce($array, $aggregator, $initial);
    }
    
    private static function containsWithComparator(array $array, $value, ComparatorInterface $comparator): bool
    {
        return static::some($array, function ($x) use ($comparator, $value) {
            return $comparator->equals($x, $value);
        });
    }

    public static function contains(array $array, $value, callable $comparator = null): bool
    {
        if (is_null($comparator)) {
            return in_array($value, $array, true);
        }
        return static::containsWithComparator($array, $value, Callables::newComparator($comparator));
    }

    public static function distinct(array $array, callable $comparator = null): array
    {
        $result = [];
        foreach ($array as $value) {
            if (! static::contains($result, $value)) {
                $result[] = $value;
            }
        }
        return $result;
    }
    
    public static function sort(array $array, callable $comparator): array
    {
        uasort($array, $comparator);
        return $array;
    }
}
