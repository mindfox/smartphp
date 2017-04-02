<?php
namespace SmartPHP\Slim;

use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SmartPHP\Interfaces\DataSourceMessageSerializerInterface;
use SmartPHP\Interfaces\DataSourceMessageFactoryInterface;
use SmartPHP\Interfaces\DataSourceFactoryInterface;
use SmartPHP\Interfaces\DataSourceInvokatorInterface;

class DataSourceController
{

    /**
     *
     * @var DataSourceMessageSerializerInterface
     */
    private $messageSerializer;

    /**
     *
     * @var DataSourceMessageFactoryInterface
     */
    private $messageFactory;

    /**
     *
     * @var DataSourceFactoryInterface
     */
    private $dataSourceFactory;

    /**
     *
     * @var DataSourceInvokatorInterface
     */
    private $dataSourceInvokator;

    public function __construct(ContainerInterface $container)
    {
        $container = DefaultDependencyProvider::register($container);
        $this->messageSerializer = $container->get(DependencyIds::MESSAGE_SERIALIZER);
        $this->messageFactory = $container->get(DependencyIds::MESSAGE_FACTORY);
        $this->dataSourceFactory = $container->get(DependencyIds::DATASOURCE_FACTORY);
        $this->dataSourceInvokator = $container->get(DependencyIds::DATASORUCE_INVOKATOR);
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        $message = $this->messageFactory->createFromServerRequest($request);
        $service = $this->dataSourceFactory->createFromDataSourceMessage($message);
        $message = $this->dataSourceInvokator->invokeDataSource($service, $message);
        
        $response->getBody()->write($this->messageSerializer->serialize($message));
        
        return $response;
    }
}