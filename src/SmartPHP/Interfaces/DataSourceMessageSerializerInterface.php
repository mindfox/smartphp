<?php
namespace SmartPHP\Interfaces;

interface DataSourceMessageSerializerInterface
{
    public function serialize(DataSourceMessageInterface $message): string;
}