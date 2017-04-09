<?php
namespace SmartPHP\DefaultImpl;

use Psr\Http\Message\ServerRequestInterface;
use SmartPHP\DefaultImpl\DataSourceRequest;
use SmartPHP\Interfaces\DSRequestFactoryInterface;
use SmartPHP\Interfaces\DSRequestInterface;

class DataSourceRequestFactory implements DSRequestFactoryInterface
{
    
    public function createDSRequestFromArray(array $array): DSRequestInterface
    {
        $dsRequest = new DataSourceRequest();
        $dsRequest->setData($array);
        return $dsRequest;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceRequestFactoryInterface::createFromServerRequest()
     */
    public function createFromServerRequest(ServerRequestInterface $request): DSRequestInterface
    {
        $parsedBody = (array) $request->getParsedBody();
        $queryParams = $request->getQueryParams();
        $array = array_merge($queryParams, $parsedBody);
        return $this->createDSRequestFromArray($array);
    }
}