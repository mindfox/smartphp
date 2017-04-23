<?php
namespace SmartPHP\Callables;

class Predicate implements PredicateInterface
{

    public function accept($value): bool
    {
        return boolval($this->call($value));
    }
}
