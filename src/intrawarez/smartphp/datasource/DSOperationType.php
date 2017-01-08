<?php
namespace intrawarez\smartphp\datasource;

abstract class DSOperationType
{
    const FETCH = "fetch";
    const ADD = "add";
    const UPDATE = "update";
    const REMOVE = "remove";
    const CUSTOM = "custom";
    const VALIDATE = "validate";
    
    public static function getTypes(): array
    {
        $reflector = new \ReflectionClass(self::class);
        
        return $reflector->getConstants();
    }
}
