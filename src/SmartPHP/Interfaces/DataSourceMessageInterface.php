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

    public function setComponentId(string $componentId): DataSourceMessageInterface;

    public function getData();

    public function setData($data): DataSourceMessageInterface;

    public function getDataSource(): string;

    public function setDataSource(string $dataSource): DataSourceMessageInterface;

    public function getEndRow(): int;

    public function setEndRow(int $endRow): DataSourceMessageInterface;

    public function getOldValues();

    public function setOldValues($oldValues): DataSourceMessageInterface;

    public function getOperationType(): string;

    public function setOperationType($operationType): DataSourceMessageInterface;

    public function getStartRow(): int;

    public function setStartRow(int $startRow): DataSourceMessageInterface;

    public function getTotalRows(): int;

    public function setTotalRows(int $totalRows): DataSourceMessageInterface;

    public function getTextMatchStyle(): string;

    public function setTextMatchStyle(string $textMatchStyle): DataSourceMessageInterface;

    public function hasDataFormat(): bool;

    public function getDataFormat(): string;

    public function setDataFormat(string $dataFormat): DataSourceMessageInterface;
}