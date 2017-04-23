<?php
namespace SmartPHP\Collections;

interface CollectionInterface extends \Countable, \IteratorAggregate
{

    public function add($element): CollectionInterface;

    public function addAll(CollectionInterface $elements): CollectionInterface;

    public function clear(): CollectionInterface;

    public function contains($element): bool;

    public function containsAll(CollectionInterface $elements): bool;

    public function isEmpty(): bool;

    public function remove($element): CollectionInterface;

    public function removeAll(CollectionInterface $elements): CollectionInterface;

    public function stream(): IteratorStreamInterface;

    public function toArray(): array;
}
