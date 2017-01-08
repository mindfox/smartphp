<?php
namespace intrawarez\smartphp\datasource;

abstract class Enum
{
    private static $reflector = null;
    private static $values = null;
    
    protected static function getReflector(): \ReflectionClass
    {
        if (is_null(self::$reflector)) {
            self::$reflector = new \ReflectionClass(static::class);
        }
        return self::$reflector;
    }
    
    public static function getValues(): array
    {
        if (is_null(self::$values)) {
            self::$values = self::getReflector()->getConstants();
        }
        return self::$values;
    }
    
    public static function isValue($value): bool
    {
        return in_array($value, self::getValues());
    }
}
