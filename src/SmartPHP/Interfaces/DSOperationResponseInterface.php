<?php
namespace SmartPHP\Interfaces;

interface DSOperationResponseInterface extends DSResponseInterface
{

    public function getResponse(): DSOperationInterface;

    public function setResponse(DSOperationInterface $response): DSOperationResponseInterface;
}