<?php
namespace intrawarez\smartphp;

abstract class AbstractDataSource implements DataSourceInterface
{

    /**
     * {@inheritDoc}
     * @see \intrawarez\smartphp\DataSourceInterface::execute()
     */
    public function execute(DSRequest $request): DSResponse
    {
        $response = new DSResponse();
        
        switch ($request->getOperationType()) {
            case DSOperationType::FETCH:
                break;
            case DSOperationType::ADD:
                break;
            case DSOperationType::UPDATE:
                break;
            case DSOperationType::REMOVE:
                break;
            default:
                throw new \InvalidArgumentException("Unsupported operation type!");
        }
        
        return $response;
    }
    
    /**
     * {@inheritDoc}
     * @see \intrawarez\smartphp\DataSourceInterface::executeTransaction()
     */
    public function executeTransaction(DSTransaction $transaction): DSResponse
    {
       foreach ($transaction as $request) {
           $this->execute($request);
       }
    }
    
}
