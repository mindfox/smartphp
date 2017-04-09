<?php
namespace SmartPHP\Slim;

use Interop\Container\ContainerInterface;
use SmartPHP\DefaultImpl\DataSourceExecutor;
use SmartPHP\DefaultImpl\DataSourceFactory;
use SmartPHP\DefaultImpl\DataSourceOperationFactory;
use SmartPHP\DefaultImpl\DataSourceRequestFactory;
use SmartPHP\DefaultImpl\DataSourceResponseSerializer;
use SmartPHP\DefaultImpl\DataSourceTransactionFactory;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

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

    private static function registerDenormalizer(ContainerInterface $container): ContainerInterface
    {
        if (! isset($container["SmartPHP/Denormalizer"])) {
            $container["SmartPHP/Denormalizer"] = function (ContainerInterface $container) {
                return new GetSetMethodNormalizer();
            };
        }
        return $container;
    }

    private static function registerResponseSerializer(ContainerInterface $container): ContainerInterface
    {
        if (! isset($container[DependencyIds::RESPONSE_SERIALIZER])) {
            $container[DependencyIds::RESPONSE_SERIALIZER] = function (ContainerInterface $container) {
                return new DataSourceResponseSerializer($container->get(DependencyIds::SERIALIZER));
            };
        }
        return $container;
    }

    private static function registerRequestFactory(ContainerInterface $container): ContainerInterface
    {
        if (! isset($container["SmartPHP/RequestFactory"])) {
            $container["SmartPHP/RequestFactory"] = function (ContainerInterface $container) {
                return new DataSourceRequestFactory();
            };
        }
        return $container;
    }

    private static function registerOperationFactory(ContainerInterface $container): ContainerInterface
    {
        if (! isset($container["SmartPHP/OperationFactory"])) {
            $container["SmartPHP/OperationFactory"] = function (ContainerInterface $container) {
                $denormalizer = $container->get("SmartPHP/Denormalizer");
                return new DataSourceOperationFactory($denormalizer);
            };
        }
        return $container;
    }

    private static function registerTransactionFactory(ContainerInterface $container): ContainerInterface
    {
        if (! isset($container["SmartPHP/TransactionFactory"])) {
            $container["SmartPHP/TransactionFactory"] = function (ContainerInterface $container) {
                $dsOperationFactory = $container->get("SmartPHP/OperationFactory");
                $denormalizer = $container->get("SmartPHP/Denormalizer");
                return new DataSourceTransactionFactory($dsOperationFactory, $denormalizer);
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

    private static function registerDataSourceExecutor(ContainerInterface $container): ContainerInterface
    {
        if (! isset($container[DependencyIds::DATASORUCE_INVOKATOR])) {
            $container[DependencyIds::DATASORUCE_INVOKATOR] = function (ContainerInterface $container) {
                $dataSourceFactory = $container->get(DependencyIds::DATASOURCE_FACTORY);
                return new DataSourceExecutor($dataSourceFactory);
            };
        }
        return $container;
    }

    public static function register(ContainerInterface $container): ContainerInterface
    {
        $container = self::registerSerializer($container);
        $container = self::registerDenormalizer($container);
        $container = self::registerOperationFactory($container);
        $container = self::registerTransactionFactory($container);
        $container = self::registerResponseSerializer($container);
        $container = self::registerRequestFactory($container);
        $container = self::registerDataSourceFactory($container);
        $container = self::registerDataSourceExecutor($container);
        return $container;
    }
}