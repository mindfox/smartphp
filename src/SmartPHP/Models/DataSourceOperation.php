<?php
namespace SmartPHP\Models;

use SmartPHP\Interfaces\DataSourceOperationInterface;

class DataSourceOperation implements DataSourceOperationInterface
{

    /**
     *
     * @var string
     */
    private $componentId = "";

    /**
     *
     * @var string
     */
    private $dataSource = "";

    /**
     *
     * @var array
     */
    private $data = [];

    /**
     *
     * @var array
     */
    private $oldValues = [];

    /**
     *
     * @var string
     */
    private $operationType = "";

    /**
     *
     * @var string
     */
    private $textMatchStyle = "";

    /**
     *
     * @var int
     */
    private $startRow = 0;

    /**
     *
     * @var int
     */
    private $endRow = 0;

    /**
     *
     * @var int
     */
    private $totalRows = 0;

    public function getComponentId(): string
    {
        return $this->componentId;
    }

    public function setComponentId($componentId): DataSourceOperationInterface
    {
        $this->componentId = strval($componentId);
        return $this;
    }

    public function getDataSource(): string
    {
        return $this->dataSource;
    }

    public function setDataSource($dataSource): DataSourceOperationInterface
    {
        $this->dataSource = strval($dataSource);
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data): DataSourceOperationInterface
    {
        $this->data = $data ?? [];
        return $this;
    }

    public function getOldValues()
    {
        return $this->oldValues;
    }

    public function setOldValues($oldValues): DataSourceOperationInterface
    {
        $this->oldValues = $oldValues ?? [];
        return $this;
    }

    public function getOperationType(): string
    {
        return $this->operationType;
    }

    public function setOperationType($operationType): DataSourceOperationInterface
    {
        $this->operationType = strval($operationType);
        return $this;
    }

    public function getTextMatchStyle(): string
    {
        return $this->textMatchStyle;
    }

    public function setTextMatchStyle($textMatchStyle): DataSourceOperationInterface
    {
        $this->textMatchStyle = strval($textMatchStyle);
        return $this;
    }

    public function getStartRow(): int
    {
        return $this->startRow;
    }

    public function setStartRow($startRow): DataSourceOperationInterface
    {
        $this->startRow = intval($startRow);
        return $this;
    }

    public function getEndRow(): int
    {
        return $this->endRow;
    }

    public function setEndRow($endRow): DataSourceOperationInterface
    {
        $this->endRow = intval($endRow);
        return $this;
    }

    public function getTotalRows(): int
    {
        return $this->totalRows;
    }

    public function setTotalRows($totalRows): DataSourceOperationInterface
    {
        $this->totalRows = intval($totalRows);
        return $this;
    }
}