<?php
namespace SmartPHP\Slim;

use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SmartPHP\Interfaces\DataSourceExecutorInterface;
use SmartPHP\Interfaces\DataSourceFactoryInterface;
use SmartPHP\Interfaces\DataSourceOperationFactoryInterface;
use SmartPHP\Interfaces\DataSourceOperationInterface;
use SmartPHP\Interfaces\DataSourceRequestFactoryInterface;
use SmartPHP\Interfaces\DataSourceRequestInterface;
use SmartPHP\Interfaces\DataSourceResponseInterface;
use SmartPHP\Interfaces\DataSourceResponseSerializerInterface;
use SmartPHP\Interfaces\DataSourceResponsesInterface;
use SmartPHP\Interfaces\DataSourceTransactionFactoryInterface;
use SmartPHP\Interfaces\DataSourceTransactionInterface;

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
     * @var DataSourceOperationFactoryInterface
     */
    private $operationFactory;

    /**
     *
     * @var DataSourceTransactionFactoryInterface
     */
    private $transactionFactory;

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
        $this->responseSerializer = $container->get(DependencyIds::RESPONSE_SERIALIZER);
        $this->operationFactory = $container->get("SmartPHP/OperationFactory");
        $this->transactionFactory = $container->get("SmartPHP/TransactionFactory");
        $this->requestFactory = $container->get("SmartPHP/RequestFactory");
        $this->dataSourceFactory = $container->get(DependencyIds::DATASOURCE_FACTORY);
        $this->dataSourceExecutor = $container->get(DependencyIds::DATASORUCE_INVOKATOR);
    }

    private function serializeResponse(DataSourceResponseInterface $dsResponse, string $format): string
    {
        return $this->responseSerializer->serializeResponse($dsResponse, $format);
    }

    private function serializeResponses(DataSourceResponsesInterface $dsResponses, string $format): string
    {
        return $this->responseSerializer->serializeResponses($dsResponses, $format);
    }

    private function createRequest(ServerRequestInterface $request): DataSourceRequestInterface
    {
        return $this->requestFactory->createFromServerRequest($request);
    }

    private function createOperation(DataSourceRequestInterface $dsRequest): DataSourceOperationInterface
    {
        return $this->operationFactory->createFromDSRequest($dsRequest);
    }

    private function createTransaction(DataSourceRequestInterface $dsRequest): DataSourceTransactionInterface
    {
        return $this->transactionFactory->createFromDSRequest($dsRequest);
    }

    private function executeOperation(DataSourceOperationInterface $operation): DataSourceResponseInterface
    {
        return $this->dataSourceExecutor->executeOperation($operation);
    }

    private function executeTransaction(DataSourceTransactionInterface $transaction): DataSourceResponsesInterface
    {
        return $this->dataSourceExecutor->executeTransaction($transaction);
    }

    private function executeTransactionRequest(DataSourceRequestInterface $dsRequest): string
    {
        $transaction = $this->createTransaction($dsRequest);
        $dsResponses = $this->executeTransaction($transaction);
        return $this->serializeResponses($dsResponses, $dsRequest->getDataFormat());
    }

    private function executeOperationRequest(DataSourceRequestInterface $dsRequest): string
    {
        $operation = $this->createOperation($dsRequest);
        $dsResponse = $this->executeOperation($operation);
        return $this->serializeResponse($dsResponse, $dsRequest->getDataFormat());
    }

    private function executeDataSourceRequest(DataSourceRequestInterface $dsRequest): string
    {
        if ($dsRequest->isTransaction()) {
            return $this->executeTransactionRequest($dsRequest);
        }
        return $this->executeOperationRequest($dsRequest);
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        $request = $this->createRequest($request);
        $content = $this->executeDataSourceRequest($request);
        $response->getBody()->write($content);
        return $response;
    }
}