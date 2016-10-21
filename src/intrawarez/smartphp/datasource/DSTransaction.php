<?php
namespace intrawarez\smartphp\datasource;

class DSTransaction implements \IteratorAggregate
{
    private $operations;
    
    
    public function getIterator(): \Iterator
    {
        return $this->operations;
    }
    
}
