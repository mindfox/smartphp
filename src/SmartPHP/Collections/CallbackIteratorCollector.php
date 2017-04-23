<?php
namespace SmartPHP\Collections;

use Iterator;
use SmartPHP\Collections\CollectionInterface;

class CallbackIteratorCollector implements IteratorCollectorInterface
{

    private $callback;
    
    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Collections\CollectorInterface::get()
     */
    public function get(Iterator $iterator): CollectionInterface
    {
        return call_user_func($this->callback, $iterator);
    }
}
