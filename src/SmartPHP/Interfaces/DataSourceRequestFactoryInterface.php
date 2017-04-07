<?php
namespace SmartPHP\Interfaces;

use Psr\Http\Message\ServerRequestInterface;

interface DataSourceRequestFactoryInterface
{
    public function createFromServerRequest(ServerRequestInterface $request): DataSourceRequestInterface;
}