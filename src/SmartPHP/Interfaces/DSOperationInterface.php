<?php
namespace SmartPHP\Interfaces;

interface DSOperationInterface
{

    /**
     * 
     * @return string
     */
    public function getComponentId(): string;

    /**
     * 
     * @param string $componentId
     * @return DSOperationInterface
     */
    public function setComponentId($componentId): DSOperationInterface;

    /**
     * 
     * @return string
     */
    public function getDataSource(): string;

    /**
     * 
     * @param string $dataSource
     * @return DSOperationInterface
     */
    public function setDataSource($dataSource): DSOperationInterface;

    /**
     * @return array|object
     */
    public function getData();

    /**
     * 
     * @param array|object $data
     * @return DSOperationInterface
     */
    public function setData($data): DSOperationInterface;

    /**
     * @return array|object
     */
    public function getOldValues();

    /**
     * 
     * @param array|object $oldValues
     * @return DSOperationInterface
     */
    public function setOldValues($oldValues): DSOperationInterface;

    /**
     * 
     * @return string
     */
    public function getOperationType(): string;

    /**
     * 
     * @param string $operationType
     * @return DSOperationInterface
     */
    public function setOperationType($operationType): DSOperationInterface;

    /**
     * 
     * @return string
     */
    public function getTextMatchStyle(): string;

    /**
     * 
     * @param string $textMatchStyle
     * @return DSOperationInterface
     */
    public function setTextMatchStyle($textMatchStyle): DSOperationInterface;

    /**
     * 
     * @return int
     */
    public function getStartRow(): int;

    /**
     * 
     * @param string $startRow
     * @return DSOperationInterface
     */
    public function setStartRow($startRow): DSOperationInterface;

    /**
     * 
     * @return int
     */
    public function getEndRow(): int;

    /**
     * 
     * @param int $endRow
     * @return DSOperationInterface
     */
    public function setEndRow($endRow): DSOperationInterface;

    /**
     * 
     * @return int
     */
    public function getTotalRows(): int;

    /**
     * 
     * @param int $totalRows
     * @return DSOperationInterface
     */
    public function setTotalRows($totalRows): DSOperationInterface;
}