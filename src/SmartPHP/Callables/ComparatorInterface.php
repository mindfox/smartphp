<?php
namespace SmartPHP\Callables;

use SmartPHP\Callables\CallableInterface;

interface ComparatorInterface extends CallableInterface
{
    /**
     *
     * @param mixed $a
     * @param mixed $b
     * @return int Returns zero if $a == $b, less than zero if $a < $b or greater than zero if $a > $b
     */
    public function compare($a, $b): int;
    
    public function equals($a, $b): bool;
    
    public function lessThan($a, $b): bool;
    
    public function lessOrEqual($a, $b): bool;
    
    public function greaterThan($a, $b): bool;
    
    public function greaterOrEqual($a, $b): bool;
}
