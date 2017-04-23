<?php
namespace SmartPHP\Collections;

class CallbackMapIterator extends \IteratorIterator
{
    private $callback;
    
    public function __construct($iterator, callable $callback)
    {
        parent::__construct($iterator);
        $this->callback = $callback;
    }
    
    public function current()
    {
        return call_user_func($this->callback, parent::current());
    }
}
