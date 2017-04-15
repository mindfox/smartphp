<?php
namespace SmartPHP\Slim;

use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SmartPHP\Interfaces\DataSourceExecutorInterface;
use SmartPHP\Interfaces\DataSourceFactoryInterface;
use SmartPHP\Interfaces\DSOperationFactoryInterface;
use SmartPHP\Interfaces\DSOperationInterface;
use SmartPHP\Interfaces\DSRequestFactoryInterface;
use SmartPHP\Interfaces\DSRequestInterface;
use SmartPHP\Interfaces\DSResponseInterface;
use SmartPHP\Interfaces\DSResponseSerializerInterface;
use SmartPHP\Interfaces\DSTransactionFactoryInterface;
use SmartPHP\Interfaces\DSTransactionInterface;
use SmartPHP\DefaultImpl\DSRequestFactory;

class DataSourceController
{

    /**
     *
     * @var DSRequestFactoryInterface
     */
    private $dsRequestFactory;

    /**
     *
     * @var DSResponseSerializerInterface
     */
    private $dsResponseSerializer;

    /**
     *
     * @var DSOperationFactoryInterface
     */
    private $dsOperationFactory;

    /**
     *
     * @var DSTransactionFactoryInterface
     */
    private $dsTransactionFactory;

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
        $this->dsResponseSerializer = $container->get("DI")->get(DSResponseSerializerInterface::class);
        $this->dsOperationFactory = $container->get("DI")->get(DSOperationFactoryInterface::class);
        $this->dsTransactionFactory = $container->get("DI")->get(DSTransactionFactoryInterface::class);
        $this->dsRequestFactory = $container->get("DI")->get(DSRequestFactoryInterface::class);
        $this->dataSourceFactory = $container->get("DI")->get(DataSourceFactoryInterface::class);
        $this->dataSourceExecutor = $container->get("DI")->get(DataSourceExecutorInterface::class);
    }

    private function serializeResponse(DSResponseInterface $dsResponse, string $format): string
    {
        return $this->dsResponseSerializer->serializeResponse($dsResponse, $format);
    }

    private function createRequest(ServerRequestInterface $request): DSRequestInterface
    {
        return $this->dsRequestFactory->createDSRequestFromServerRequest($request);
    }

    private function createOperation(DSRequestInterface $dsRequest): DSOperationInterface
    {
        return $this->dsOperationFactory->createDSOperationFromDSRequest($dsRequest);
    }

    private function createTransaction(DSRequestInterface $dsRequest): DSTransactionInterface
    {
        return $this->dsTransactionFactory->createDSTransactionFromDSRequest($dsRequest);
    }

    private function executeOperation(DSOperationInterface $operation): DSResponseInterface
    {
        return $this->dataSourceExecutor->executeOperation($operation);
    }

    private function executeTransaction(DSTransactionInterface $transaction): DSResponseInterface
    {
        return $this->dataSourceExecutor->executeTransaction($transaction);
    }

    private function executeTransactionRequest(DSRequestInterface $dsRequest): string
    {
        $transaction = $this->createTransaction($dsRequest);
        $dsResponse = $this->executeTransaction($transaction);
        return $this->serializeResponse($dsResponse, $dsRequest->getDataFormat());
    }

    private function executeOperationRequest(DSRequestInterface $dsRequest): string
    {
        $operation = $this->createOperation($dsRequest);
        $dsResponse = $this->executeOperation($operation);
        return $this->serializeResponse($dsResponse, $dsRequest->getDataFormat());
    }

    private function executeDataSourceRequest(DSRequestInterface $dsRequest): string
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
