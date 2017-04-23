<?php
namespace SmartPHP\Collections;

use Iterator;
use EmptyIterator;
use AppendIterator;
use CallbackFilterIterator;
use SmartPHP\Callables\PredicateInterface;
use SmartPHP\Callables\Callables;
use SmartPHP\Callables\ComparatorInterface;

abstract class Iterators
{

    public static function append(Iterator $iterator1, Iterator $iterator2): Iterator
    {
        $iterator = new AppendIterator();
        $iterator->append($iterator1);
        $iterator->append($iterator2);
        return $iterator;
    }

    private static function allWithPredicate(Iterator $iterator, PredicateInterface $predicate): bool
    {
        foreach ($iterator as $value) {
            if (! $predicate->accept($value)) {
                return false;
            }
        }
        return true;
    }

    public static function all(Iterator $iterator, callable $predicate): bool
    {
        return static::allWithPredicate($iterator, Callables::newPredicate($predicate));
    }

    private static function someWithPredicate(Iterator $iterator, PredicateInterface $predicate): bool
    {
        foreach ($iterator as $value) {
            if ($predicate->accept($value)) {
                return true;
            }
        }
        return false;
    }

    public static function some(Iterator $iterator, callable $predicate): bool
    {
        return static::someWithPredicate($iterator, Callables::newPredicate($predicate));
    }

    public static function none(Iterator $iterator, callable $predicate): bool
    {
        return ! static::all($iterator, $predicate);
    }

    public static function collect(Iterator $iterator, IteratorCollectorInterface $collector): CollectionInterface
    {
        return $collector->get($iterator);
    }

    private static function containsWithComparator(Iterator $iterator, $element, ComparatorInterface $comparator): bool
    {
        return static::some($iterator, function ($value) use ($comparator, $element) {
            return $comparator->equals($value, $element);
        });
    }

    public static function contains(Iterator $iterator, $element, callable $comparator = null): bool
    {
        if (is_null($comparator)) {
            $comparator = function ($value) use ($element) {
                return $value === $element;
            };
        }
        return static::containsWithComparator($iterator, $element, Callables::newComparator($comparator));
    }

    public static function count(Iterator $iterator): int
    {
        return iterator_count($iterator);
    }

    public static function each(Iterator $iterator, callable $callable): \Iterator
    {
        iterator_apply($iterator, $callable);
        return $iterator;
    }

    public static function empty(): Iterator
    {
        return new EmptyIterator();
    }

    public static function filter(Iterator $iterator, callable $predicate): \Iterator
    {
        return new CallbackFilterIterator($iterator, $predicate);
    }

    public static function first(Iterator $iterator): OptionalInterface
    {
        foreach ($iterator as $value) {
            return Optional::of($value);
        }
        return Optional::absent();
    }

    public static function last(Iterator $iterator): OptionalInterface
    {
        if (! (static::isEmpty($iterator) || static::isInfinite($iterator))) {
            $values = static::toArray($iterator);
            return Optional::of($values[count($values) - 1]);
        }
        return Optional::absent();
    }

    public static function sort(Iterator $iterator, callable $comparator): \Iterator
    {
        if (! static::isInfinite($iterator)) {
            if (static::isEmpty($iterator)) {
                return $iterator;
            }
            return Arrays::sort(static::toArray($iterator), $comparator);
        }
        throw new \LogicException("Cannot sort infinite iterator!");
    }

    public static function max(Iterator $iterator, callable $comparator): OptionalInterface
    {
        if (! (static::isEmpty($iterator) || static::isInfinite($iterator))) {
            return Arrays::max(static::toArray($iterator), $comparator);
        }
        return Optional::absent();
    }

    public static function min(Iterator $iterator, callable $comparator): OptionalInterface
    {
        if (! (static::isEmpty($iterator) || static::isInfinite($iterator))) {
            return Arrays::min(static::toArray($iterator), $comparator);
        }
        return Optional::absent();
    }

    public static function isEmpty(Iterator $iterator): bool
    {
        return $iterator instanceof \EmptyIterator || static::count($iterator) === 0;
    }

    public static function isInfinite(Iterator $iterator): bool
    {
        return $iterator instanceof \InfiniteIterator;
    }

    public static function partition(Iterator $iterator, int $offset, int $length): \Iterator
    {
        return new \LimitIterator($iterator, $offset, $length);
    }

    public static function limit(Iterator $iterator, int $limit): \Iterator
    {
        return static::partition($iterator, 0, $limit);
    }

    public static function map(Iterator $iterator, callable $functor): \Iterator
    {
        return new CallbackMapIterator($iterator, $functor);
    }

    public static function reduce(Iterator $iterator, $initial, callable $aggregator)
    {
        return Arrays::reduce(static::toArray($iterator), $initial, $aggregator);
    }

    public static function toArray(Iterator $iterator): array
    {
        return iterator_to_array($iterator);
    }

    public static function fromArray(array $array): \Iterator
    {
        return new \ArrayIterator($array);
    }
}
