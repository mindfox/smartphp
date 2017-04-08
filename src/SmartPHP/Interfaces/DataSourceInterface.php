<?php
namespace SmartPHP\Interfaces;

interface DataSourceInterface
{
    public function fetch(DataSourceOperationInterface $message): DataSourceOperationInterface;
    public function add(DataSourceOperationInterface $message): DataSourceOperationInterface;
    public function update(DataSourceOperationInterface $message): DataSourceOperationInterface;
    public function remove(DataSourceOperationInterface $message): DataSourceOperationInterface;
}