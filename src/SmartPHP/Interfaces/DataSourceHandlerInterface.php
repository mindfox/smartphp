<?php
namespace SmartPHP\Interfaces;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface DataSourceHandlerInterface
{
    public function getDataSourceFactory(): DataSourceFactoryInterface;
    public function handleRequest(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface;
}
