<?php
namespace SmartPHP\Collections;

use IteratorAggregate;
use IteratorIterator;

class Iterable extends IteratorIterator implements IteratorAggregate
{

    /**
     *
     * {@inheritdoc}
     *
     * @see IteratorAggregate::getIterator()
     */
    public function getIterator()
    {
        return $this->getInnerIterator();
    }
}
