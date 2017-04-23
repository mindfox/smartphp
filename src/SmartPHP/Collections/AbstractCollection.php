<?php
namespace SmartPHP\Collections;

abstract class AbstractCollection implements CollectionInterface
{

    public function addAll(CollectionInterface $elements): CollectionInterface
    {
        foreach ($elements as $element) {
            $this->addElement($element);
        }
        return $this;
    }

    public function containsAll(CollectionInterface $elements): bool
    {
        foreach ($elements as $element) {
            if (! $this->contains($element)) {
                return false;
            }
        }
        return true;
    }

    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }

    public function removeAll(CollectionInterface $elements): CollectionInterface
    {
        foreach ($elements as $element) {
            $this->removeElement($element);
        }
        return $this;
    }

    public function stream(): IteratorStreamInterface
    {
        return IteratorStream::create($this->getIterator());
    }

    public function toArray(): array
    {
        return $this->stream()->toArray();
    }
}
