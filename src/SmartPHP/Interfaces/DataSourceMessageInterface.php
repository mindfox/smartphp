<?php
namespace SmartPHP\Interfaces;

interface DataSourceMessageInterface
{

    public function hasComponentId(): bool;

    public function hasData(): bool;

    public function hasDataSource(): bool;

    public function hasEndRow(): bool;

    public function hasOldValues(): bool;

    public function hasOperationType(): bool;

    public function hasStartRow(): bool;

    public function hasTextMatchStyle(): bool;

    public function hasTotalRows(): bool;

    public function getComponentId(): string;

    public function setComponentId(string $componentId): self;

    public function getData();

    public function setData($data): self;

    public function getDataSource(): string;

    public function setDataSource(string $dataSource): self;

    public function getEndRow(): int;

    public function setEndRow(int $endRow): self;

    public function getOldValues();

    public function setOldValues($oldValues): self;

    public function getOperationType(): string;

    public function setOperationType($operationType): self;

    public function getStartRow(): int;

    public function setStartRow(int $startRow): self;

    public function getTotalRows(): int;

    public function setTotalRows(int $totalRows): self;

    public function getTextMatchStyle(): string;

    public function setTextMatchStyle(string $textMatchStyle): self;

    public function hasDataFormat(): bool;

    public function getDataFormat(): string;

    public function setDataFormat(string $dataFormat): self;
}