<?php
namespace SmartPHP\Interfaces;

interface DataSourceOperationInterface
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

    public function setComponentId(string $componentId): DataSourceOperationInterface;

    public function getData();

    public function setData($data): DataSourceOperationInterface;

    public function getDataSource(): string;

    public function setDataSource(string $dataSource): DataSourceOperationInterface;

    public function getEndRow(): int;

    public function setEndRow(int $endRow): DataSourceOperationInterface;

    public function getOldValues();

    public function setOldValues($oldValues): DataSourceOperationInterface;

    public function getOperationType(): string;

    public function setOperationType($operationType): DataSourceOperationInterface;

    public function getStartRow(): int;

    public function setStartRow(int $startRow): DataSourceOperationInterface;

    public function getTotalRows(): int;

    public function setTotalRows(int $totalRows): DataSourceOperationInterface;

    public function getTextMatchStyle(): string;

    public function setTextMatchStyle(string $textMatchStyle): DataSourceOperationInterface;

    public function hasDataFormat(): bool;

    public function getDataFormat(): string;

    public function setDataFormat(string $dataFormat): DataSourceOperationInterface;
}