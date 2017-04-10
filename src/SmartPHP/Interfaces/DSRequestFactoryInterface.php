<?php
namespace SmartPHP\Interfaces;

use Psr\Http\Message\ServerRequestInterface;

interface DSRequestFactoryInterface
{
    public function createDSRequestFromArray(array $array): DSRequestInterface;
    
    public function createDSRequestFromServerRequest(ServerRequestInterface $request): DSRequestInterface;
}
