<?php
namespace SmartPHP;

use Interop\Container\ContainerInterface;
use SmartPHP\DefaultImpl\DataSourceExecutor;
use SmartPHP\DefaultImpl\DataSourceFactory;
use SmartPHP\DefaultImpl\DataSourceHandler;
use SmartPHP\DefaultImpl\DataSourceModelConverterFactory;
use SmartPHP\DefaultImpl\DSOperationFactory;
use SmartPHP\DefaultImpl\DSRequestFactory;
use SmartPHP\DefaultImpl\DSResponseSerializer;
use SmartPHP\DefaultImpl\DSTransactionFactory;
use SmartPHP\DI\DIDefinitionBuilderInterface;
use SmartPHP\DI\DIDefinitionProviderInterface;
use SmartPHP\Interfaces\DataSourceExecutorInterface;
use SmartPHP\Interfaces\DataSourceFactoryInterface;
use SmartPHP\Interfaces\DataSourceHandlerInterface;
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

class DefaultDIDefinitionProvider implements DIDefinitionProviderInterface
{
    public static function create(): DIDefinitionProviderInterface
    {
        return new static();
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\DI\DIDefinitionProviderInterface::configureDIDefinitions()
     */
    public function configureDIDefinitions(DIDefinitionBuilderInterface $diDefinitionBuilder)
    {
        $diDefinitionBuilder->register("SmartPHP.serializer.normalizers", [
            new GetSetMethodNormalizer()
        ]);
        
        $diDefinitionBuilder->register("SmartPHP.serializer.encoders", [
            new JsonEncoder(),
            new XmlEncoder()
        ]);
        
        $diDefinitionBuilder->register(SerializerInterface::class, function (ContainerInterface $container) {
            $normalizers = $container->get("SmartPHP.serializer.normalizers");
            $encoders = $container->get("SmartPHP.serializer.encoders");
            return new Serializer($normalizers, $encoders);
        });
        
        $diDefinitionBuilder->registerClassAs(GetSetMethodNormalizer::class, AbstractNormalizer::class);
        
        $diDefinitionBuilder->registerClassAs(GetSetMethodNormalizer::class, DenormalizerInterface::class);
        
        $diDefinitionBuilder->registerClassAs(GetSetMethodNormalizer::class, NormalizerInterface::class);
        
        $diDefinitionBuilder->registerClassAs(DSOperationFactory::class, DSOperationFactoryInterface::class);
        
        $diDefinitionBuilder->registerClassAs(DSTransactionFactory::class, DSTransactionFactoryInterface::class);
        
        $diDefinitionBuilder->registerClassAs(DSRequestFactory::class, DSRequestFactoryInterface::class);
        
        $diDefinitionBuilder->register(DataSourceFactoryInterface::class, function (ContainerInterface $container) {
            return new DataSourceFactory($container);
        });
        
        $diDefinitionBuilder->register(DSResponseSerializerInterface::class, function (ContainerInterface $container) {
            $serializer = $container->get(SerializerInterface::class);
            $jsonPrefix = $container->get("SmartPHP.jsonPrefix");
            $jsonSuffix = $container->get("SmartPHP.jsonSuffix");
            return new DSResponseSerializer($serializer, $jsonPrefix, $jsonSuffix);
        });
        
        $diDefinitionBuilder->registerClassAs(DataSourceExecutor::class, DataSourceExecutorInterface::class);
        
        $diDefinitionBuilder->registerClassAs(DataSourceModelConverterFactory::class, DataSourceModelConverterFactoryInterface::class);
        
        $diDefinitionBuilder->registerClassAs(DataSourceHandler::class, DataSourceHandlerInterface::class);
    }
}
