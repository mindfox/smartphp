<?php
namespace SmartPHP\Interfaces;

interface OptionalInterface
{

    public function isPesent(): bool;

    public function isAbsent(): bool;

    public function getValue();
}
