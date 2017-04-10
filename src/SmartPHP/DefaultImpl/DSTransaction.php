<?php
namespace SmartPHP\DefaultImpl;

use SmartPHP\Interfaces\DSTransactionInterface;
use SmartPHP\Interfaces\DSOperationInterface;

class DSTransaction implements DSTransactionInterface
{

    /**
     *
     * @var int
     */
    private $transactionNum = -1;
    
    /**
     *
     * @var string
     */
    private $dataFormat = "";

    /**
     *
     * @var array
     */
    private $operations = [];

    public function getTransactionNum(): int
    {
        return $this->transactionNum;
    }

    public function setTransactionNum(int $transactionNum): DSTransactionInterface
    {
        $this->transactionNum = $transactionNum;
        return $this;
    }

    public function getOperations(): array
    {
        return $this->operations;
    }

    public function addOperation(DSOperationInterface $operation): DSTransactionInterface
    {
        $this->operations[] = $operation;
        return $this;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceTransactionInterface::getDataFormat()
     */
    public function getDataFormat(): string
    {
        return $this->dataFormat;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceTransactionInterface::setDataFormat()
     */
    public function setDataFormat(string $dataFormat): DSTransactionInterface
    {
        $this->dataFormat = $dataFormat;
        return $this;
    }
}
