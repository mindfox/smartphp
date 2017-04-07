<?php
namespace SmartPHP\Models;

use SmartPHP\Interfaces\DataSourceOperationInterface;

class DataSourceOperation implements DataSourceOperationInterface
{

    /**
     *
     * @var string
     */
    private $dataFormat;

    /**
     *
     * @var string
     */
    private $componentId;

    /**
     *
     * @var mixed
     */
    private $data;

    /**
     *
     * @var string
     */
    private $dataSource;

    /**
     *
     * @var int
     */
    private $endRow;

    /**
     *
     * @var mixed
     */
    private $oldValues;

    /**
     *
     * @var string
     */
    private $operationType;

    /**
     *
     * @var int
     */
    private $startRow;

    /**
     *
     * @var int
     */
    private $totalRows;

    /**
     *
     * @var string
     */
    private $textMatchStyle;

    public function __construct(string $componentId = "", string $dataSource = "", string $operationType = "", string $textMatchStyle = "", int $startRow = 0, int $endRow = 0, int $totalRows = 0, $data = null, $oldValues = null)
    {
        $this->componentId = $componentId;
        $this->dataSource = $dataSource;
        $this->operationType = $operationType;
        $this->startRow = $startRow;
        $this->endRow = $endRow;
        $this->totalRows = $totalRows;
        $this->textMatchStyle = $textMatchStyle;
        $this->data = $data;
        $this->oldValues = $oldValues;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceOperationInterface::hasComponentId()
     */
    public function hasComponentId(): bool
    {
        return ! empty($this->componentId);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceOperationInterface::hasData()
     */
    public function hasData(): bool
    {
        return is_array($this->data) || is_object($this->data);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceOperationInterface::hasDataSource()
     */
    public function hasDataSource(): bool
    {
        return ! empty($this->dataSource);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceOperationInterface::hasEndRow()
     */
    public function hasEndRow(): bool
    {
        return is_int($this->endRow);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceOperationInterface::hasOldValues()
     */
    public function hasOldValues(): bool
    {
        return is_array($this->oldValues) || is_object($this->oldValues);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceOperationInterface::hasOperationType()
     */
    public function hasOperationType(): bool
    {
        return ! empty($this->operationType);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceOperationInterface::hasStartRow()
     */
    public function hasStartRow(): bool
    {
        return is_int($this->startRow);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceOperationInterface::hasTextMatchStyle()
     */
    public function hasTextMatchStyle(): bool
    {
        return ! empty($this->textMatchStyle);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceOperationInterface::hasTotalRows()
     */
    public function hasTotalRows(): bool
    {
        return is_int($this->totalRows);
    }

    public function getComponentId(): string
    {
        return $this->componentId;
    }

    public function setComponentId(string $componentId): DataSourceOperationInterface
    {
        $this->componentId = $componentId;
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data): DataSourceOperationInterface
    {
        $this->data = $data;
        return $this;
    }

    public function getDataSource(): string
    {
        return $this->dataSource;
    }

    public function setDataSource(string $dataSource): DataSourceOperationInterface
    {
        $this->dataSource = $dataSource;
        return $this;
    }

    public function getEndRow(): int
    {
        return $this->endRow;
    }

    public function setEndRow(int $endRow): DataSourceOperationInterface
    {
        $this->endRow = $endRow;
        return $this;
    }

    public function getOldValues()
    {
        return $this->oldValues;
    }

    public function setOldValues($oldValues): DataSourceOperationInterface
    {
        $this->oldValues = $oldValues;
        return $this;
    }

    public function getOperationType(): string
    {
        return $this->operationType;
    }

    public function setOperationType($operationType): DataSourceOperationInterface
    {
        $this->operationType = strtolower($operationType);
        return $this;
    }

    public function getStartRow(): int
    {
        return $this->startRow;
    }

    public function setStartRow(int $startRow): DataSourceOperationInterface
    {
        $this->startRow = $startRow;
        return $this;
    }

    public function getTotalRows(): int
    {
        return $this->totalRows;
    }

    public function setTotalRows(int $totalRows): DataSourceOperationInterface
    {
        $this->totalRows = $totalRows;
        return $this;
    }

    public function getTextMatchStyle(): string
    {
        return $this->textMatchStyle;
    }

    public function setTextMatchStyle(string $textMatchStyle): DataSourceOperationInterface
    {
        $this->textMatchStyle = $textMatchStyle;
        return $this;
    }

    public function hasDataFormat(): bool
    {
        return ! empty($this->dataFormat);
    }

    public function getDataFormat(): string
    {
        return $this->dataFormat;
    }

    public function setDataFormat(string $dataFormat): DataSourceOperationInterface
    {
        $this->dataFormat = $dataFormat;
        return $this;
    }
}