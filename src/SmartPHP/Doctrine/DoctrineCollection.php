<?php
namespace SmartPHP\Doctrine;

use SmartPHP\Collections\AbstractCollection;
use Doctrine\Common\Collections\Collection;
use SmartPHP\Collections\CollectionInterface;

class DoctrineCollection extends AbstractCollection
{

    public static function create(Collection $collection)
    {
        return new static($collection);
    }

    /**
     *
     * @var Collection
     */
    private $collection;

    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see Countable::count()
     */
    public function count(): int
    {
        return $this->collection->count();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Collections\CollectionInterface::add()
     */
    public function add($element): CollectionInterface
    {
        $this->collection->add($element);
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
        $this->collection->clear();
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
        return $this->collection->contains($element);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Collections\CollectionInterface::isEmpty()
     */
    public function isEmpty(): bool
    {
        return $this->collection->isEmpty();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Collections\CollectionInterface::remove()
     */
    public function remove($element): CollectionInterface
    {
        $this->collection->removeElement($element);
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
        return $this->collection->toArray();
    }
}
