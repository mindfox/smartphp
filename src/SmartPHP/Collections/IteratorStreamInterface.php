<?php
namespace SmartPHP\Collections;

use Slim\Interfaces\CollectionInterface;

interface IteratorStreamInterface
{
    public function all(callable $predicate): bool;
    public function any(callable $predicate): bool;
    public function collect(CollectorInterface $collector): CollectionInterface;
    public function count(): int;
    public function each(callable $callable): IteratorStreamInterface;
    public function filter(callable $predicate): IteratorStreamInterface;
    public function first(): OptionalInterface;
    public function map(callable $functor): IteratorStreamInterface;
    public function reduce($start, callable $aggregator);
    public function toArray(): array;
}
