<?php
namespace SmartPHP\Collections;

use \Iterator;
use SmartPHP\Collections\CollectionInterface;

interface CollectorInterface
{
    public function get(Iterator $iterator): CollectionInterface;
}
