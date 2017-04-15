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

    private function buildDSOperationResponse(DSOperationInterface $dsOperation): DSResponseInterface
    {
        $dsResponse = new DSOperationResponse();
        $dsResponse->setResponse($dsOperation);
        return $dsResponse;
    }

    private function setDSOperationDataAndRows(DSOperationInterface $dsOperation, array $data): DSOperationInterface
    {
        $dsOperation->setData($data);
        $dsOperation->setTotalRows(count($data));
        return $dsOperation;
    }

    private function executeFetch(DSOperationInterface $dsOperation): DSResponseInterface
    {
        $dataSource = $this->getDataSource($dsOperation);
        $data = $dataSource->fetch($dsOperation->getStartRow(), $dsOperation->getEndRow());
        return $this->buildDSOperationResponse($this->setDSOperationDataAndRows($dsOperation, $data));
    }

    private function executeAdd(DSOperationInterface $dsOperation): DSResponseInterface
    {
        $dataSource = $this->getDataSource($dsOperation);
        $dsOperation->setData($dataSource->add($dsOperation->getData()));
        return $this->buildDSOperationResponse($dsOperation);
    }

    private function executeUpdate(DSOperationInterface $dsOperation): DSResponseInterface
    {
        $dataSource = $this->getDataSource($dsOperation);
        $dsOperation->setData($dataSource->update($dsOperation->getData(), $dsOperation->getOldValues()));
        return $this->buildDSOperationResponse($dsOperation);
    }

    private function executeRemove(DSOperationInterface $dsOperation): DSResponseInterface
    {
        $dataSource = $this->getDataSource($dsOperation);
        $dsOperation->setData($dataSource->remove($dsOperation->getData()));
        return $this->buildDSOperationResponse($dsOperation);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceExecutorInterface::executeOperation()
     */
    public function executeOperation(DSOperationInterface $dsOperation): DSResponseInterface
    {
        switch (strtolower($dsOperation->getOperationType())) {
            case DSOperationType::FETCH:
                return $this->executeFetch($dsOperation);
            
            case DSOperationType::ADD:
                return $this->executeAdd($dsOperation);
            
            case DSOperationType::UPDATE:
                return $this->executeUpdate($dsOperation);
            
            case DSOperationType::REMOVE:
                return $this->executeRemove($dsOperation);
        }
        
        throw new \Exception("Unknown OperationType '".$dsOperation->getOperationType()."'!");
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
