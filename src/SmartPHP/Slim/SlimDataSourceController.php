<?php
namespace SmartPHP\Slim;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use SmartPHP\Interfaces\DataSourceFactoryInterface;
use SmartPHP\Interfaces\DataSourceHandlerInterface;

class SlimDataSourceController
{

    /**
     *
     * @var DataSourceHandlerInterface
     */
    private $dataSourceHandler;

    public function __construct(DataSourceHandlerInterface $dataSourceHandler)
    {
        $this->dataSourceHandler = $dataSourceHandler;
        $this->configureDataSources($this->dataSourceHandler->getDataSourceFactory());
    }

    protected function configureDataSources(DataSourceFactoryInterface $dataSourceFactory)
    {
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->dataSourceHandler->handleRequest($request, $response);
    }
}
