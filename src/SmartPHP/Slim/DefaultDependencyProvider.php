<?php
namespace SmartPHP\Slim;

use Interop\Container\ContainerInterface;
use SmartPHP\DefaultImpl\DataSourceExecutor;
use SmartPHP\DefaultImpl\DataSourceFactory;
use SmartPHP\DefaultImpl\DSOperationFactory;
use SmartPHP\DefaultImpl\DSRequestFactory;
use SmartPHP\DefaultImpl\DSResponseSerializer;
use SmartPHP\DefaultImpl\DSTransactionFactory;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

final class DefaultDependencyProvider
{

    private static function defineDefaultProvider(ContainerInterface $container, string $id, callable $provider): ContainerInterface
    {
        if (! isset($container[$id])) {
            $container[$id] = $provider;
        }
        return $container;
    }

    private static function registerSerializer(ContainerInterface $container): ContainerInterface
    {
        return self::defineDefaultProvider($container, DependencyIds::SERIALIZER, function (ContainerInterface $container) {
            $encoders = [
                new JsonEncoder(),
                new XmlEncoder()
            ];
            
            $normalizers = [
                new GetSetMethodNormalizer()
            ];
            
            $serializer = new Serializer($normalizers, $encoders);
            
            return $serializer;
        });
    }

    private static function registerDenormalizer(ContainerInterface $container): ContainerInterface
    {
        return self::defineDefaultProvider($container, DependencyIds::DENORMALIZER, function (ContainerInterface $container) {
            return new GetSetMethodNormalizer();
        });
    }

    private static function registerResponseSerializer(ContainerInterface $container): ContainerInterface
    {
        return self::defineDefaultProvider($container, DependencyIds::DS_RESPONSE_SERIALIZER, function (ContainerInterface $container) {
            return new DSResponseSerializer($container->get(DependencyIds::SERIALIZER));
        });
    }

    private static function registerRequestFactory(ContainerInterface $container): ContainerInterface
    {
        return self::defineDefaultProvider($container, DependencyIds::DS_REQUEST_FACTORY, function (ContainerInterface $container) {
            return new DSRequestFactory();
        });
    }

    private static function registerOperationFactory(ContainerInterface $container): ContainerInterface
    {
        return self::defineDefaultProvider($container, DependencyIds::DS_OPERATION_FACTORY, function (ContainerInterface $container) {
            $denormalizer = $container->get(DependencyIds::DENORMALIZER);
            return new DSOperationFactory($denormalizer);
        });
    }

    private static function registerTransactionFactory(ContainerInterface $container): ContainerInterface
    {
        return self::defineDefaultProvider($container, DependencyIds::DS_TRANSACTION_FACTORY, function (ContainerInterface $container) {
            $dsOperationFactory = $container->get(DependencyIds::DS_OPERATION_FACTORY);
            $denormalizer = $container->get(DependencyIds::DENORMALIZER);
            return new DSTransactionFactory($dsOperationFactory, $denormalizer);
        });
    }

    private static function registerDataSourceFactory(ContainerInterface $container): ContainerInterface
    {
        return self::defineDefaultProvider($container, DependencyIds::DATASOURCE_FACTORY, function (ContainerInterface $container) {
            return new DataSourceFactory($container);
        });
    }

    private static function registerDataSourceExecutor(ContainerInterface $container): ContainerInterface
    {
        return self::defineDefaultProvider($container, DependencyIds::DATASORUCE_EXECUTOR, function (ContainerInterface $container) {
            $dataSourceFactory = $container->get(DependencyIds::DATASOURCE_FACTORY);
            return new DataSourceExecutor($dataSourceFactory);
        });
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
