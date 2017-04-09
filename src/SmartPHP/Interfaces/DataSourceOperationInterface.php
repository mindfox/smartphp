<?php
namespace SmartPHP\Interfaces;

interface DataSourceOperationInterface
{

    /**
     * 
     * @return string
     */
    public function getComponentId(): string;

    /**
     * 
     * @param string $componentId
     * @return DataSourceOperationInterface
     */
    public function setComponentId($componentId): DataSourceOperationInterface;

    /**
     * 
     * @return string
     */
    public function getDataSource(): string;

    /**
     * 
     * @param string $dataSource
     * @return DataSourceOperationInterface
     */
    public function setDataSource($dataSource): DataSourceOperationInterface;

    /**
     * @return array|object
     */
    public function getData();

    /**
     * 
     * @param array|object $data
     * @return DataSourceOperationInterface
     */
    public function setData($data): DataSourceOperationInterface;

    /**
     * @return array|object
     */
    public function getOldValues();

    /**
     * 
     * @param array|object $oldValues
     * @return DataSourceOperationInterface
     */
    public function setOldValues($oldValues): DataSourceOperationInterface;

    /**
     * 
     * @return string
     */
    public function getOperationType(): string;

    /**
     * 
     * @param string $operationType
     * @return DataSourceOperationInterface
     */
    public function setOperationType($operationType): DataSourceOperationInterface;

    /**
     * 
     * @return string
     */
    public function getTextMatchStyle(): string;

    /**
     * 
     * @param string $textMatchStyle
     * @return DataSourceOperationInterface
     */
    public function setTextMatchStyle($textMatchStyle): DataSourceOperationInterface;

    /**
     * 
     * @return int
     */
    public function getStartRow(): int;

    /**
     * 
     * @param string $startRow
     * @return DataSourceOperationInterface
     */
    public function setStartRow($startRow): DataSourceOperationInterface;

    /**
     * 
     * @return int
     */
    public function getEndRow(): int;

    /**
     * 
     * @param int $endRow
     * @return DataSourceOperationInterface
     */
    public function setEndRow($endRow): DataSourceOperationInterface;

    /**
     * 
     * @return int
     */
    public function getTotalRows(): int;

    /**
     * 
     * @param int $totalRows
     * @return DataSourceOperationInterface
     */
    public function setTotalRows($totalRows): DataSourceOperationInterface;
}