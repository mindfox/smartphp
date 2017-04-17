<?php
namespace SmartPHP;

use Interop\Container\ContainerInterface;
use SmartPHP\DefaultImpl\DataSourceExecutor;
use SmartPHP\DefaultImpl\DataSourceFactory;
use SmartPHP\DefaultImpl\DataSourceModelConverterFactory;
use SmartPHP\DefaultImpl\DSOperationFactory;
use SmartPHP\DefaultImpl\DSRequestFactory;
use SmartPHP\DefaultImpl\DSResponseSerializer;
use SmartPHP\DefaultImpl\DSTransactionFactory;
use SmartPHP\Interfaces\DataSourceExecutorInterface;
use SmartPHP\Interfaces\DataSourceFactoryInterface;
use SmartPHP\Interfaces\DataSourceModelConverterFactoryInterface;
use SmartPHP\Interfaces\DSOperationFactoryInterface;
use SmartPHP\Interfaces\DSRequestFactoryInterface;
use SmartPHP\Interfaces\DSResponseSerializerInterface;
use SmartPHP\Interfaces\DSTransactionFactoryInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use SmartPHP\DI\DIBuilder;
use SmartPHP\Interfaces\DataSourceControllerInterface;
use SmartPHP\DefaultImpl\DataSourceController;

final class DefaultDIProvider
{

    public static function register(DIBuilder $diBuilder, ContainerInterface $container)
    {
        $diBuilder->register(SerializerInterface::class, function () {
            $normalizers = [
                new GetSetMethodNormalizer()
            ];
            $encoders = [
                new JsonEncoder(),
                new XmlEncoder()
            ];
            return new Serializer($normalizers, $encoders);
        });
        
        $diBuilder->registerClassAs(GetSetMethodNormalizer::class, AbstractNormalizer::class);
        
        $diBuilder->registerClassAs(GetSetMethodNormalizer::class, DenormalizerInterface::class);
        
        $diBuilder->registerClassAs(GetSetMethodNormalizer::class, NormalizerInterface::class);
        
        $diBuilder->registerClassAs(DSOperationFactory::class, DSOperationFactoryInterface::class);
        
        $diBuilder->registerClassAs(DSTransactionFactory::class, DSTransactionFactoryInterface::class);
        
        $diBuilder->registerClassAs(DSRequestFactory::class, DSRequestFactoryInterface::class);
        
        $diBuilder->register(DataSourceFactoryInterface::class, function ($di) {
            return new DataSourceFactory($di);
        });
        
        $diBuilder->register(DSResponseSerializerInterface::class, function ($di) use ($container) {
            $serializer = $di->get(SerializerInterface::class);
            $config = $container->get("SmartPHP");
            $jsonPrefix = $config["jsonPrefix"];
            $jsonSuffix = $config["jsonSuffix"];
            return new DSResponseSerializer($serializer, $jsonPrefix, $jsonSuffix);
        });
        
        $diBuilder->registerClassAs(DataSourceExecutor::class, DataSourceExecutorInterface::class);
        
        $diBuilder->registerClassAs(DataSourceModelConverterFactory::class, DataSourceModelConverterFactoryInterface::class);
        
        $diBuilder->registerClassAs(DataSourceController::class, DataSourceControllerInterface::class);
    }
}
