<?php
namespace SmartPHP\Services;

use SmartPHP\Interfaces\DataSourceRequestFactoryInterface;
use SmartPHP\Interfaces\DataSourceRequestInterface;
use SmartPHP\Models\DataSourceRequest;
use Psr\Http\Message\ServerRequestInterface;

class DataSourceRequestFactory implements DataSourceRequestFactoryInterface
{
    
    public function createDSRequestFromArray(array $array): DataSourceRequestInterface
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
    public function createFromServerRequest(ServerRequestInterface $request): DataSourceRequestInterface
    {
        $parsedBody = (array) $request->getParsedBody();
        $queryParams = $request->getQueryParams();
        $array = array_merge($queryParams, $parsedBody);
        return $this->createDSRequestFromArray($array);
    }
}