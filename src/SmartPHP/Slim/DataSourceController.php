<?php
namespace SmartPHP\Slim;

use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SmartPHP\Interfaces\DataSourceMessageSerializerInterface;
use SmartPHP\Interfaces\DataSourceMessageFactoryInterface;
use SmartPHP\Interfaces\DataSourceServiceFactoryInterface;
use SmartPHP\Interfaces\DataSourceServiceInvokatorInterface;

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
     * @var DataSourceServiceFactoryInterface
     */
    private $serviceFactory;

    /**
     *
     * @var DataSourceServiceInvokatorInterface
     */
    private $serviceInvokator;

    public function __construct(ContainerInterface $container)
    {
        $this->messageSerializer = $container->get("SmartPHP/Serializer");
        $this->messageFactory = $container->get("SmartPHP/MessageFactory");
        $this->serviceFactory = $container->get("SmartPHP/ServiceFactory");
        $this->serviceInvokator = $container->get("SmartPHP/ServiceInvokator");
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        $message = $this->messageFactory->createFromServerRequest($request);
        $service = $this->serviceFactory->createFromDataSourceMessage($message);
        $message = $this->serviceInvokator->invokeService($service, $message);
        
        $response->getBody()->write($this->messageSerializer->serialize($message));
        
        return $response;
    }
}