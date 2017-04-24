<?php
namespace SmartPHP\Collections;

interface OptionalInterface
{

    public function isPesent(): bool;

    public function isAbsent(): bool;

    public function getValue();
    
    public function map(callable $functor): OptionalInterface;
}
