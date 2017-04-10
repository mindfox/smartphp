<?php
namespace SmartPHP\DefaultImpl;

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
        return $this->dataSourceFactory->createDataSourceFromOperation($operation);
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
        $response = new DSOperationResponse();
        
        switch (strtolower($operation->getOperationType())) {
            case DSOperationType::FETCH:
                $operation = $dataSource->fetch($operation);
                break;
            
            case DSOperationType::ADD:
                $operation = $dataSource->add($operation);
                break;
            
            case DSOperationType::UPDATE:
                $operation = $dataSource->update($operation);
                break;
            
            case DSOperationType::REMOVE:
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
        $responses = new DSTransactionResponse();
        
        foreach ($transaction->getOperations() as $operation) {
            $responses->addResponse($this->executeOperation($operation));
        }
        
        return $responses;
    }
}
