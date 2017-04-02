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
        $this->messageSerializer = $container->get("SmartPHP/Serializer");
        $this->messageFactory = $container->get("SmartPHP/MessageFactory");
        $this->dataSourceFactory = $container->get("SmartPHP/ServiceFactory");
        $this->dataSourceInvokator = $container->get("SmartPHP/ServiceInvokator");
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