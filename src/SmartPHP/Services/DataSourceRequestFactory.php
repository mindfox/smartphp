<?php
namespace SmartPHP\Services;

use SmartPHP\Interfaces\DataSourceRequestFactoryInterface;
use SmartPHP\Interfaces\DataSourceRequestInterface;
use SmartPHP\Models\DataSourceRequest;
use Psr\Http\Message\ServerRequestInterface;

class DataSourceRequestFactory implements DataSourceRequestFactoryInterface
{

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceRequestFactoryInterface::createFromServerRequest()
     */
    public function createFromServerRequest(ServerRequestInterface $request): DataSourceRequestInterface
    {
        $dsRequest = new DataSourceRequest();
        $dsRequest->setData((array) $request->getParsedBody());
        return $dsRequest;
    }
}