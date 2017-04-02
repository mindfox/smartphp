<?php
namespace SmartPHP\Interfaces;

interface DataSourceServiceInvokatorInterface
{
    public function invokeService(DataSourceServiceInterface $service, DataSourceMessageInterface $message): DataSourceMessageInterface;
}