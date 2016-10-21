<?php
namespace intrawarez\smartphp\datasource;

interface RequestHandlerInterface
{
    /**
     *
     * @param DSRequest $request
     * @return DSResponse
     */
    public function executeRequest(DSRequest $request): DSResponse;
    
    /**
     *
     * @param DSTransaction $transaction
     * @return DSResponse
     */
    public function executeTransaction(DSTransaction $transaction): DSResponse;
}
