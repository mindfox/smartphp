<?php
namespace SmartPHP\DI;

use DI;
use DI\Definition\Helper\ObjectDefinitionHelper;

class DIDefinitionBuilder implements DIDefinitionBuilderInterface
{

    /**
     *
     * @var array
     */
    private $definitions = [];

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\DI\DIDefinitionBuilderInterface::register()
     */
    public function register(string $key, $value)
    {
        $this->definitions[$key] = $value;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\DI\DIDefinitionBuilderInterface::registerClassAs()
     */
    public function registerClassAs(string $className, string $asName): ObjectDefinitionHelper
    {
        $helper = DI\object($className);
        $this->register($asName, $helper);
        return $helper;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\DI\DIDefinitionBuilderInterface::registerClassAsInterface()
     */
    public function registerClassAsInterface(string $className): ObjectDefinitionHelper
    {
        $reflectionClass = new \ReflectionClass($className);
        $interfaces = $reflectionClass->getInterfaceNames();
        return $this->registerClassAs($className, $interfaces[0]);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\DI\DIDefinitionBuilderInterface::getDefinitions()
     */
    public function getDefinitions(): array
    {
        return $this->definitions;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\DI\DIDefinitionBuilderInterface::configure()
     */
    public function configure(DIDefinitionProviderInterface $diDefinitionProvider)
    {
        $diDefinitionProvider->configureDIDefinitions($this);
    }
}
