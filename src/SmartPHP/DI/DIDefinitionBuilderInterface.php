<?php
namespace SmartPHP\DI;

use DI\Definition\Helper\ObjectDefinitionHelper;

interface DIDefinitionBuilderInterface
{
    public function register(string $key, $value);
    
    public function registerClassAs(string $className, string $asName): ObjectDefinitionHelper;
    
    public function registerClassAsInterface(string $className): ObjectDefinitionHelper;
    
    public function getDefinitions(): array;
    
    public function configure(DIDefinitionProviderInterface $diDefinitionProvider);
}
