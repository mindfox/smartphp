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

    private static function defaultSerializer(ContainerInterface $container)
    {
        $encoders = [
            new JsonEncoder(),
            new XmlEncoder()
        ];
        
        $normalizers = [
            new GetSetMethodNormalizer()
        ];
        
        $serializer = new Serializer($normalizers, $encoders);
        
        return $serializer;
    }

    private static function defaultDenormalizer(ContainerInterface $container)
    {
        return new GetSetMethodNormalizer();
    }

    private static function defaultResponseSerializer(ContainerInterface $container)
    {
        return new DSResponseSerializer($container->get(DependencyIds::SERIALIZER));
    }

    private static function defaultRequestFactory(ContainerInterface $container)
    {
        return new DSRequestFactory();
    }

    private static function defaultOperationFactory(ContainerInterface $container)
    {
        $denormalizer = $container->get(DependencyIds::DENORMALIZER);
        return new DSOperationFactory($denormalizer);
    }

    private static function defaultTransactionFactory(ContainerInterface $container)
    {
        $dsOperationFactory = $container->get(DependencyIds::DS_OPERATION_FACTORY);
        $denormalizer = $container->get(DependencyIds::DENORMALIZER);
        return new DSTransactionFactory($dsOperationFactory, $denormalizer);
    }

    private static function defaultDataSourceFactory(ContainerInterface $container)
    {
        return new DataSourceFactory($container);
    }

    private static function defaultDataSourceExecutor(ContainerInterface $container)
    {
        $dataSourceFactory = $container->get(DependencyIds::DATASOURCE_FACTORY);
        return new DataSourceExecutor($dataSourceFactory);
    }

    private static function registerDefaultProvider(ContainerInterface $container, string $id, string $methodName)
    {
        $provider = new \ReflectionClass(self::class);
        if (! isset($container[$id]) && $provider->hasMethod($methodName)) {
            $container[$id] = $provider->getMethod($methodName)->getClosure($provider->newInstanceWithoutConstructor());
        }
    }

    private static function registerDefaultProviders(ContainerInterface $container, array $providers)
    {
        foreach ($providers as $id => $methodName) {
            self::registerDefaultProvider($container, $id, $methodName);
        }
    }

    public static function register(ContainerInterface $container)
    {
        self::registerDefaultProviders($container, [
            
            DependencyIds::DENORMALIZER => "defaultDenormalizer",
            
            DependencyIds::SERIALIZER => "defaultSerializer",
            
            DependencyIds::DS_RESPONSE_SERIALIZER => "defaultResponseSerializer",
            
            DependencyIds::DS_REQUEST_FACTORY => "defaultRequestFactory",
            
            DependencyIds::DS_OPERATION_FACTORY => "defaultOperationFactory",
            
            DependencyIds::DS_TRANSACTION_FACTORY => "defaultTransactionFactory",
            
            DependencyIds::DATASOURCE_FACTORY => "defaultDataSourceFactory",
            
            DependencyIds::DATASORUCE_EXECUTOR => "defaultDataSourceExecutor"
        ]);
        return $container;
    }
}
