<?php
namespace SmartPHP;

use DI;
use Interop\Container\ContainerInterface;
use SmartPHP\DefaultImpl\DSResponseSerializer;
use SmartPHP\DI\DIBuilder;

final class DefaultDependencyProvider
{

    private static function defaultConfig(ContainerInterface $container)
    {
        return [
            
            "jsonPrefix" => DSResponseSerializer::RESTDATASOURCE_JSON_PREFIX,
            
            "jsonSuffix" => DSResponseSerializer::RESTDATASOURCE_JSON_SUFFIX
        
        ];
    }

    public static function register(ContainerInterface $container)
    {
        $container["DIBuilder"] = function (ContainerInterface $container) {
            return new DIBuilder();
        };
        
        $container["DI"] = function (ContainerInterface $container) {
            return $container->get("DIBuilder")->build();
        };
    }
}
