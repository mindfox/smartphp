<?php
namespace SmartPHP\DI;

interface DIDefinitionProviderInterface
{
    public function configureDIDefinitions(DIDefinitionBuilderInterface $diDefinitionBuilder);
}
