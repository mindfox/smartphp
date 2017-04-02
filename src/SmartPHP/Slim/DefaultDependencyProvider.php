<?php
namespace SmartPHP\Slim;

use Interop\Container\ContainerInterface;
use SmartPHP\Services\DataSourceMessageFactory;
use SmartPHP\Services\DataSourceMessageSerializer;
use SmartPHP\Services\DataSourceFactory;
use SmartPHP\Services\DataSourceInvokator;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;

final class DefaultDependencyProvider
{

    private static function registerSerializer(ContainerInterface $container): ContainerInterface
    {
        if (! isset($container[DependencyIds::SERIALIZER])) {
            $container[DependencyIds::SERIALIZER] = function (ContainerInterface $container) {
                $encoders = [
                    new JsonEncoder(),
                    new XmlEncoder()
                ];
                
                $normalizers = [
                    new GetSetMethodNormalizer()
                ];
                
                $serializer = new Serializer($normalizers, $encoders);
                
                return $serializer;
            };
        }
        return $container;
    }
    
    private static function registerMessageSerializer(ContainerInterface $container): ContainerInterface
    {
        if (! isset($container[DependencyIds::MESSAGE_SERIALIZER])) {
            $container[DependencyIds::MESSAGE_SERIALIZER] = function (ContainerInterface $container) {
                return new DataSourceMessageSerializer($container->get(DependencyIds::SERIALIZER));
            };
        }
        return $container;
    }

    private static function registerMessageFactory(ContainerInterface $container): ContainerInterface
    {
        if (! isset($container[DependencyIds::MESSAGE_FACTORY])) {
            $container[DependencyIds::MESSAGE_FACTORY] = function (ContainerInterface $container) {
                return new DataSourceMessageFactory();
            };
        }
        return $container;
    }

    private static function registerDataSourceFactory(ContainerInterface $container): ContainerInterface
    {
        if (! isset($container[DependencyIds::DATASOURCE_FACTORY])) {
            $container[DependencyIds::DATASOURCE_FACTORY] = function (ContainerInterface $container) {
                return new DataSourceFactory($container);
            };
        }
        return $container;
    }

    private static function registerDataSourceInvokator(ContainerInterface $container): ContainerInterface
    {
        if (! isset($container[DependencyIds::DATASORUCE_INVOKATOR])) {
            $container[DependencyIds::DATASORUCE_INVOKATOR] = function (ContainerInterface $container) {
                return new DataSourceInvokator();
            };
        }
        return $container;
    }

    public static function register(ContainerInterface $container): ContainerInterface
    {
        $container = self::registerSerializer($container);
        $container = self::registerMessageSerializer($container);
        $container = self::registerMessageFactory($container);
        $container = self::registerDataSourceFactory($container);
        $container = self::registerDataSourceInvokator($container);
        return $container;
    }
}