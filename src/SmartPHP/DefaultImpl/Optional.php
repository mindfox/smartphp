<?php
namespace SmartPHP\DefaultImpl;

use SmartPHP\Interfaces\OptionalInterface;

class Optional implements OptionalInterface
{

    public static function of($value): OptionalInterface
    {
        return new self($value);
    }

    public static function absent(): OptionalInterface
    {
        return new self(null);
    }

    private $value;

    private function __construct($value)
    {
        $this->value = $value;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\OptionalInterface::isPesent()
     */
    public function isPesent()
    {
        return ! $this->isAbsent();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\OptionalInterface::isAbsent()
     */
    public function isAbsent()
    {
        return is_null($this->value);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\OptionalInterface::getValue()
     */
    public function getValue()
    {
        return $this->value;
    }
}
