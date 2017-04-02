<?php
namespace maxmeffert\smartphp;

class DataSourceMessage implements DataSourceMessageInterface
{

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

    private function createImmutable(): self
    {
        return new self($this->componentId, $this->dataSource, $this->operationType, $this->textMatchStyle, $this->startRow, $this->endRow, $this->totalRows, $this->data, $this->oldValues);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceMessageInterface::hasComponentId()
     */
    public function hasComponentId(): bool
    {
        return ! empty($this->componentId);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceMessageInterface::getComponentId()
     */
    public function getComponentId(): string
    {
        return $this->componentId;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceMessageInterface::withComponentId()
     */
    public function withComponentId(string $componentId): self
    {
        $this->componentId = $componentId;
        return $this->createImmutable();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceMessageInterface::hasData()
     */
    public function hasData(): bool
    {
        return is_array($this->data) || is_object($this->data);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceMessageInterface::getData()
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceMessageInterface::withData()
     */
    public function withData($data): self
    {
        $this->data = $data;
        return $this->createImmutable();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceMessageInterface::hasDataSource()
     */
    public function hasDataSource(): bool
    {
        return ! empty($this->dataSource);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceMessageInterface::getDataSource()
     */
    public function getDataSource()
    {
        return $this->dataSource;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceMessageInterface::withDataSource()
     */
    public function withDataSource(string $dataSource): self
    {
        $this->dataSource = $dataSource;
        return $this->createImmutable();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceMessageInterface::hasEndRow()
     */
    public function hasEndRow(): bool
    {
        return is_int($this->endRow);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceMessageInterface::getEndRow()
     */
    public function getEndRow(): int
    {
        return $this->endRow;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceMessageInterface::withEndRow()
     */
    public function withEndRow(int $endRow): self
    {
        $this->endRow = $endRow;
        return $this->createImmutable();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceMessageInterface::hasOldValues()
     */
    public function hasOldValues(): bool
    {
        return is_array($this->oldValues) || is_object($this->oldValues);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceMessageInterface::getOldValues()
     */
    public function getOldValues()
    {
        return $this->oldValues;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceMessageInterface::withOldValues()
     */
    public function withOldValues($oldValues): self
    {
        $this->oldValues = $oldValues;
        return $this->createImmutable();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceMessageInterface::hasOperationType()
     */
    public function hasOperationType(): bool
    {
        return ! empty($this->operationType);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceMessageInterface::getOperationType()
     */
    public function getOperationType(): string
    {
        return $this->operationType;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceMessageInterface::withOperationType()
     */
    public function withOperationType(string $operationType): self
    {
        $this->operationType = $operationType;
        return $this->createImmutable();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceMessageInterface::hasStartRow()
     */
    public function hasStartRow(): bool
    {
        return is_int($this->startRow);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceMessageInterface::getStartRow()
     */
    public function getStartRow(): int
    {
        return $this->startRow;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceMessageInterface::withStartRow()
     */
    public function withStartRow(int $startRow): self
    {
        $this->startRow = $startRow;
        return $this->createImmutable();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceMessageInterface::hasTextMatchStyle()
     */
    public function hasTextMatchStyle()
    {
        return ! empty($this->textMatchStyle);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceMessageInterface::getTextMatchStyle()
     */
    public function getTextMatchStyle(): string
    {
        return $this->textMatchStyle;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceMessageInterface::withTextMatchStyle()
     */
    public function withTextMatchStyle(string $textMatchStyle): self
    {
        $this->textMatchStyle = $textMatchStyle;
        return $this->createImmutable();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceMessageInterface::hasTotalRows()
     */
    public function hasTotalRows(): bool
    {
        return is_int($this->totalRows);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceMessageInterface::getTotalRows()
     */
    public function getTotalRows(): int
    {
        return $this->totalRows;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \maxmeffert\smartphp\DataSourceMessageInterface::withTotalRows()
     */
    public function withTotalRows(int $totalRows): self
    {
        $this->totalRows = $totalRows;
        return $this->createImmutable();
    }
}