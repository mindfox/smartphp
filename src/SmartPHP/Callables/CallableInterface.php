<?php
namespace SmartPHP\Callables;

interface CallableInterface
{
    public function getCallable(): callable;
    public function call();
    public function callArgs(array $args);
    public function __invoke();
}
