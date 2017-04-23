<?php
namespace SmartPHP\Callables;

use SmartPHP\Callables\CallableInterface;

interface PredicateInterface extends CallableInterface
{
    public function accept($value): bool;
}
