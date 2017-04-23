<?php
namespace SmartPHP\Collections;

class ArrayCollection extends AbstractCollection
{

    /**
     *
     * @var array
     */
    private $elements;

    public function __construct(array $array = [])
    {
        $this->elements = $array;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Collections\CollectionInterface::add()
     */
    public function add($element): CollectionInterface
    {
        $this->elements[] = $element;
        return $this;
    }

    

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Collections\CollectionInterface::clear()
     */
    public function clear(): CollectionInterface
    {
        $this->elements = [];
        return $this;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Collections\CollectionInterface::contains()
     */
    public function contains($element): bool
    {
        return array_search($element, $this->elements, true) !== false;
    }

    /**
     *
     * {@inheritDoc}
     * @see Countable::count()
     */
    public function count(): int
    {
        return count($this->elements);
    }

    /**
     *
     * {@inheritDoc}
     * @see IteratorAggregate::getIterator()
     */
    public function getIterator(): \Iterator
    {
        return new \ArrayIterator($this->elements);
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Collections\CollectionInterface::isEmpty()
     */
    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Collections\CollectionInterface::remove()
     */
    public function remove($element): CollectionInterface
    {
        $key = array_search($element, $this->elements, true);
        if ($key !== false) {
            unset($this->elements[$key]);
        }
        return $this;
    }
        
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Collections\CollectionInterface::toArray()
     */
    public function toArray(): array
    {
        return array_merge($this->elements);
    }
}
