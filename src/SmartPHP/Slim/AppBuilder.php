<?php
namespace SmartPHP\Slim;

use Interop\Container\ContainerInterface;
use Slim\App;
use Slim\Container;
use SmartPHP\DefaultDIProvider;
use SmartPHP\DI\DIBuilder;
use SmartPHP\Interfaces\DataSourceControllerInterface;
use SmartPHP\Interfaces\DataSourceFactoryInterface;

abstract class AppBuilder
{

    public static function create(): AppBuilder
    {
        return new static();
    }

    abstract protected function getSettings(): array;

    abstract protected function configureDIBuilder(DIBuilder $diBuilder, ContainerInterface $container);

    abstract protected function configureContainer(ContainerInterface $container);

    abstract protected function configureRoutes(App $app);

    abstract protected function configureMiddlewares(App $app);

    /**
     *
     * @var DIBuilder
     */
    private $diBuilder;

    /**
     *
     * @var ContainerInterface
     */
    private $diContainer;

    /**
     *
     * @var DataSourceFactoryInterface
     */
    private $dataSourceFactory;

    private function __construct()
    {
        $this->diBuilder = new DIBuilder();
    }

    private function initContainer(ContainerInterface $container)
    {
        $diBuilder = $this->diBuilder;
        DefaultDIProvider::register($diBuilder, $container);
        $container["SmartPHP.DI"] = function(ContainerInterface $container) use($diBuilder) {
             return $diBuilder->build();
        };
        $container["SmartPHP.DataSourceController"] = function(ContainerInterface $container) {
            return $container->get("SmartPHP.DI")->get(DataSourceControllerInterface::class);
        };
    }

    private function configureAppContainer(ContainerInterface $container)
    {
        $this->configureContainer($container);
        $this->configureDIBuilder($this->diBuilder, $container);
    }

    private function configureApp(App $app)
    {
        $this->configureAppContainer($app->getContainer());
        $this->configureRoutes($app);
        $this->configureMiddlewares($app);
    }

    public function build(): App
    {
        $app = new App($this->getSettings());
        $this->initContainer($app->getContainer());
        $this->configureApp($app);
        return $app;
    }
}
