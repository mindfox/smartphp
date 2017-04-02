<?php
namespace SmartPHP\Interfaces;

use Psr\Http\Message\ServerRequestInterface;

interface DataSourceMessageFactoryInterface
{

    public function createFromArray(array $array): DataSourceMessageInterface;

    public function createFromServerRequest(ServerRequestInterface $request): DataSourceMessageInterface;
}