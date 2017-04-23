<?php
namespace SmartPHP\Collections;

abstract class Collections
{
    public static function newArrayCollection(array $elements = []): ArrayCollection
    {
        return new ArrayCollection($elements);
    }
}
