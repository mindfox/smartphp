<?php
namespace SmartPHP\Interfaces;

interface DataSourceInterface
{
    public function fetch(DSOperationInterface $dsOperation): DSOperationInterface;
    public function add(DSOperationInterface $dsOperation): DSOperationInterface;
    public function update(DSOperationInterface $dsOperation): DSOperationInterface;
    public function remove(DSOperationInterface $dsOperation): DSOperationInterface;
}
