<?php
namespace SmartPHP\Collections;

use \Iterator;
use SmartPHP\Collections\CollectionInterface;

interface IteratorCollectorInterface
{
    public function get(Iterator $iterator): CollectionInterface;
}
