<?php
namespace SmartPHP\DefaultImpl;

use Psr\Http\Message\ServerRequestInterface;
use SmartPHP\Interfaces\DSRequestFactoryInterface;
use SmartPHP\Interfaces\DSRequestInterface;

class DSRequestFactory implements DSRequestFactoryInterface
{

    /**
     *
     * {@inheritDoc}
     * @see \SmartPHP\Interfaces\DSRequestFactoryInterface::createDSRequestFromArray()
     */
    public function createDSRequestFromArray(array $array): DSRequestInterface
    {
        $dsRequest = new DSRequest();
        $dsRequest->setData($array);
        return $dsRequest;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceRequestFactoryInterface::createDSRequestFromServerRequest()
     */
    public function createDSRequestFromServerRequest(ServerRequestInterface $request): DSRequestInterface
    {
        $parsedBody = (array) $request->getParsedBody();
        $queryParams = $request->getQueryParams();
        $array = array_merge($queryParams, $parsedBody);
        return $this->createDSRequestFromArray($array);
    }
}
