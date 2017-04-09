
<?php
namespace SmartPHP\Models;

use SmartPHP\Interfaces\DataSourceTransactionInterface;

class DataSourceTransaction implements DataSourceTransactionInterface
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

    public function setTransactionNum(int $transactionNum): DataSourceTransactionInterface
    {
        $this->transactionNum = $transactionNum;
        return $this;
    }

    public function getOperations(): array
    {
        return $this->operations;
    }

    public function addOperation(DataSourceOperation $operation): DataSourceTransactionInterface
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
    public function setDataFormat(string $dataFormat): DataSourceTransactionInterface
    {
        $this->dataFormat = $dataFormat;
        return $this;
    }
}