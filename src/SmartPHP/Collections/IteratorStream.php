<?php
namespace SmartPHP\Collections;

use Iterator;

class IteratorStream implements IteratorStreamInterface
{

    public static function create(Iterator $iterator)
    {
        return new static($iterator);
    }

    /**
     *
     * @var Iterator
     */
    private $iterator;

    private function __construct(Iterator $iterator)
    {
        $this->iterator = $iterator;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Collections\IteratorStreamInterface::all()
     */
    public function all(callable $predicate): bool
    {
        return Iterators::all($this->iterator, $predicate);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Collections\IteratorStreamInterface::any()
     */
    public function any($predicate): bool
    {
        return Iterators::any($this->iterator, $predicate);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Collections\IteratorStreamInterface::filter()
     */
    public function filter(callable $predicate): IteratorStreamInterface
    {
        return static::create(Iterators::filter($this->iterator, $predicate));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Collections\IteratorStreamInterface::map()
     */
    public function map(callable $functor): IteratorStreamInterface
    {
        return static::create(Iterators::map($this->iterator, $functor));
    }

    public function reduce($start, callable $aggregator)
    {
        return Iterators::reduce($this->iterator, $start, $aggregator);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Collections\IteratorStreamInterface::collect()
     */
    public function collect(CollectorInterface $collector): CollectionInterface
    {
        return Iterators::collect($this->iterator, $collector);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Collections\Iterators\Streams\IteratorStreamInterface::toArray()
     */
    public function toArray(): array
    {
        return Iterators::toArray($this->iterator);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Collections\IteratorStreamInterface::count()
     */
    public function count(): int
    {
        return Iterators::count($this->iterator);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Collections\IteratorStreamInterface::each()
     */
    public function each($callable): IteratorStreamInterface
    {
        return static::create(Iterators::each($this->iterator, $callable));
    }
}
