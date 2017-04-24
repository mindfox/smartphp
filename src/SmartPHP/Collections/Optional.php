<?php
namespace SmartPHP\Collections;

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
    public function isPesent(): bool
    {
        return ! $this->isAbsent();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\OptionalInterface::isAbsent()
     */
    public function isAbsent(): bool
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

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Collections\OptionalInterface::map()
     */
    public function map(callable $functor): OptionalInterface
    {
        if ($this->isPesent()) {
            return static::of(call_user_func($functor, $this->getValue()));
        }
        return static::absent();
    }
}
