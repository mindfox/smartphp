<?php
namespace SmartPHP\DefaultImpl;

use SmartPHP\Interfaces\DSOperationInterface;

class DataSourceOperation implements DSOperationInterface
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

    public function setComponentId($componentId): DSOperationInterface
    {
        $this->componentId = strval($componentId);
        return $this;
    }

    public function getDataSource(): string
    {
        return $this->dataSource;
    }

    public function setDataSource($dataSource): DSOperationInterface
    {
        $this->dataSource = strval($dataSource);
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data): DSOperationInterface
    {
        $this->data = $data ?? [];
        return $this;
    }

    public function getOldValues()
    {
        return $this->oldValues;
    }

    public function setOldValues($oldValues): DSOperationInterface
    {
        $this->oldValues = $oldValues ?? [];
        return $this;
    }

    public function getOperationType(): string
    {
        return $this->operationType;
    }

    public function setOperationType($operationType): DSOperationInterface
    {
        $this->operationType = strval($operationType);
        return $this;
    }

    public function getTextMatchStyle(): string
    {
        return $this->textMatchStyle;
    }

    public function setTextMatchStyle($textMatchStyle): DSOperationInterface
    {
        $this->textMatchStyle = strval($textMatchStyle);
        return $this;
    }

    public function getStartRow(): int
    {
        return $this->startRow;
    }

    public function setStartRow($startRow): DSOperationInterface
    {
        $this->startRow = intval($startRow);
        return $this;
    }

    public function getEndRow(): int
    {
        return $this->endRow;
    }

    public function setEndRow($endRow): DSOperationInterface
    {
        $this->endRow = intval($endRow);
        return $this;
    }

    public function getTotalRows(): int
    {
        return $this->totalRows;
    }

    public function setTotalRows($totalRows): DSOperationInterface
    {
        $this->totalRows = intval($totalRows);
        return $this;
    }
}
