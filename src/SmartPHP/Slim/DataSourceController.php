<?php
namespace SmartPHP\Slim;

use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SmartPHP\Interfaces\DataSourceMessageSerializerInterface;
use SmartPHP\Interfaces\DataSourceMessageFactoryInterface;
use SmartPHP\Interfaces\DataSourceFactoryInterface;
use SmartPHP\Interfaces\DataSourceInvokatorInterface;
use SmartPHP\Interfaces\DataSourceRequestFactoryInterface;
use SmartPHP\Interfaces\DataSourceExecutorInterface;
use SmartPHP\Interfaces\DataSourceResponseSerializerInterface;
use SmartPHP\Interfaces\DataSourceRequestInterface;
use SmartPHP\Interfaces\DataSourceTransactionInterface;
use SmartPHP\Interfaces\DataSourceOperationInterface;

class DataSourceController
{

    /**
     *
     * @var DataSourceRequestFactoryInterface
     */
    private $requestFactory;

    /**
     *
     * @var DataSourceResponseSerializerInterface
     */
    private $responseSerializer;

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
     * @var DataSourceExecutorInterface
     */
    private $dataSourceExecutor;

    public function __construct(ContainerInterface $container)
    {
        $container = DefaultDependencyProvider::register($container);
        $this->messageSerializer = $container->get(DependencyIds::MESSAGE_SERIALIZER);
        $this->messageFactory = $container->get(DependencyIds::MESSAGE_FACTORY);
        $this->dataSourceFactory = $container->get(DependencyIds::DATASOURCE_FACTORY);
        $this->dataSourceInvokator = $container->get(DependencyIds::DATASORUCE_INVOKATOR);
    }

    private function executeDataSourceTransaction(DataSourceTransactionInterface $transaction): string
    {
        $responses = $this->dataSourceExecutor->executeTransaction($dataSource, $transaction);
        return $this->responseSerializer->serializeResponses($responses);
    }

    private function executeDataSourceOperation(DataSourceOperationInterface $operation): string
    {
        $response = $this->dataSourceExecutor->executeOperation($dataSource, $operation);
        return $this->responseSerializer->serializeResponse($response);
    }

    private function executeDataSourceRequest(DataSourceRequestInterface $request): string
    {
        if ($request->isTransaction()) {
            return $this->executeDataSourceTransaction($transaction);
        }
        return $this->executeDataSourceOperation($operation);
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        $request= $this->requestFactory->createFromServerRequest($request);
        $content = $this->executeDataSourceRequest($request);
        $response->getBody()->write($content);
        
        return $response;
    }
}