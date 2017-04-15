<?php
namespace SmartPHP\DI;

use DI;
use DI\ContainerBuilder;
use DI\Definition\Helper\ObjectDefinitionHelper;

class DIBuilder
{

    private $definitions = [];

    public function register(string $key, $value)
    {
        $this->definitions[$key] = $value;
    }

    public function registerClassAs(string $className, string $asName): ObjectDefinitionHelper
    {
        $helper = DI\object($className);
        $this->register($asName, $helper);
        return $helper;
    }

    public function registerClassAsInterface(string $className): ObjectDefinitionHelper
    {
        $reflectionClass = new \ReflectionClass($className);
        $interfaces = $reflectionClass->getInterfaceNames();
        return $this->registerClassAs($className, $interfaces[0]);
    }

    public function build()
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions($this->definitions);
        return $builder->build();
    }
}
