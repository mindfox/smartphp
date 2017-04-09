<?php
namespace SmartPHP\DefaultImpl;

use SmartPHP\DefaultImpl\DataSourceOperationType;
use SmartPHP\DefaultImpl\DataSourceResponse;
use SmartPHP\DefaultImpl\DataSourceResponses;
use SmartPHP\Interfaces\DataSourceExecutorInterface;
use SmartPHP\Interfaces\DataSourceFactoryInterface;
use SmartPHP\Interfaces\DataSourceInterface;
use SmartPHP\Interfaces\DSOperationInterface;
use SmartPHP\Interfaces\DSResponseInterface;
use SmartPHP\Interfaces\DSTransactionInterface;

class DataSourceExecutor implements DataSourceExecutorInterface
{

    /**
     *
     * @var DataSourceFactoryInterface
     */
    private $dataSourceFactory;

    public function __construct(DataSourceFactoryInterface $dataSourceFactory)
    {
        $this->dataSourceFactory = $dataSourceFactory;
    }

    private function getDataSource(DSOperationInterface $operation): DataSourceInterface
    {
        return $this->dataSourceFactory->createFromDataSourceMessage($operation);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceExecutorInterface::executeOperation()
     */
    public function executeOperation(DSOperationInterface $operation): DSResponseInterface
    {
        $dataSource = $this->getDataSource($operation);
        $response = new DataSourceResponse();
        
        switch (strtolower($operation->getOperationType())) {
            
            case DataSourceOperationType::FETCH:
                $operation = $dataSource->fetch($operation);
                break;
            
            case DataSourceOperationType::ADD:
                $operation = $dataSource->add($operation);
                break;
            
            case DataSourceOperationType::UPDATE:
                $operation = $dataSource->update($operation);
                break;
            
            case DataSourceOperationType::REMOVE:
                $operation = $dataSource->remove($operation);
                break;
            
            default:
                throw new \Exception("Unknown OperationType!");
        }
        
        $response->setResponse($operation);
        
        return $response;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceExecutorInterface::executeTransaction()
     */
    public function executeTransaction(DSTransactionInterface $transaction): DSResponseInterface
    {
        $responses = new DataSourceResponses();
        
        foreach ($transaction->getOperations() as $operation) {
            $responses->addResponse($this->executeOperation($operation));
        }
        
        return $responses;
    }
}