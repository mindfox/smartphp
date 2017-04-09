
<?php
namespace SmartPHP\Services;

use SmartPHP\Interfaces\DataSourceInterface;
use SmartPHP\Interfaces\DataSourceOperationInterface;
use SmartPHP\Models\DataSourceOperationType;
use SmartPHP\Interfaces\DataSourceExecutorInterface;
use SmartPHP\Interfaces\DataSourceResponseInterface;
use SmartPHP\Interfaces\DataSourceResponsesInterface;
use SmartPHP\Interfaces\DataSourceTransactionInterface;
use SmartPHP\Models\DataSourceResponse;
use SmartPHP\Models\DataSourceResponses;
use SmartPHP\Interfaces\DataSourceFactoryInterface;

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

    private function getDataSource(DataSourceOperationInterface $operation): DataSourceInterface
    {
        return $this->dataSourceFactory->createFromDataSourceMessage($operation);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceExecutorInterface::executeOperation()
     */
    public function executeOperation(DataSourceOperationInterface $operation): DataSourceResponseInterface
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
    public function executeTransaction(DataSourceTransactionInterface $transaction): DataSourceResponsesInterface
    {
        $responses = new DataSourceResponses();
        
        foreach ($transaction->getOperations() as $operation) {
            $responses->addResponse($this->executeOperation($operation));
        }
        
        return $responses;
    }
}