<?php
namespace SmartPHP\Interfaces;

use Psr\Http\Message\ServerRequestInterface;

interface DSRequestFactoryInterface
{
    public function createFromServerRequest(ServerRequestInterface $request): DSRequestFactoryInterface;
}
