<?php
namespace SmartPHP\Interfaces;

interface DataSourceServiceInterface
{
    public function fetch(DataSourceMessageInterface $message): DataSourceMessageInterface;
    public function add(DataSourceMessageInterface $message): DataSourceMessageInterface;
    public function update(DataSourceMessageInterface $message): DataSourceMessageInterface;
    public function remove(DataSourceMessageInterface $message): DataSourceMessageInterface;
}