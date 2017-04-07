<?php
namespace SmartPHP\Interfaces;

interface DataSourceInterface
{
    public function fetch(DataSourceOperationInterface $message): DataSourceMessageInterface;
    public function add(DataSourceOperationInterface $message): DataSourceMessageInterface;
    public function update(DataSourceOperationInterface $message): DataSourceMessageInterface;
    public function remove(DataSourceOperationInterface $message): DataSourceMessageInterface;
}