<?php
namespace SmartPHP\Slim;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use SmartPHP\Interfaces\DataSourceControllerInterface;
use Interop\Container\ContainerInterface;
use SmartPHP\Interfaces\DataSourceFactoryInterface;

class SlimDataSourceHandler
{

    /**
     *
     * @var DataSourceControllerInterface
     */
    private $dataSourceController;

    public function __construct(ContainerInterface $container)
    {
        $this->dataSourceController = $container->get("SmartPHP.DataSourceController");
        $this->configureDataSources($this->dataSourceController->getDataSourceFactory());
    }

    protected function configureDataSources(DataSourceFactoryInterface $dataSourceFactory)
    {
        // nothing todo here
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->dataSourceController->handleRequest($request, $response);
    }
}
