<?php
namespace SmartPHP\Slim;

use Interop\Container\ContainerInterface;
use Slim\App;
use Slim\Container;
use SmartPHP\DI\DIBuilder;
use SmartPHP\DefaultDIProvider;
use SmartPHP\DefaultDependencyProvider;

abstract class AppBuilder
{

    public static function create(): AppBuilder
    {
        return new static();
    }
    
    protected function getSettings(): array
    {
        return [];
    }

    protected function configureDIBuilder(DIBuilder $diBuilder, ContainerInterface $container)
    {
    }

    protected function configureContainer(ContainerInterface $container)
    {
    }

    protected function configureRoutes(App $app)
    {
    }

    protected function configureMiddlewares(App $app)
    {
    }

    private function getDIBuilder(ContainerInterface $container): DIBuilder
    {
        return $container->get("DIBuilder");
    }

    private function initContainer(ContainerInterface $container)
    {
        DefaultDependencyProvider::register($container);
        DefaultDIProvider::register($this->getDIBuilder($container), $container);
    }

    private function configureAppContainer(ContainerInterface $container)
    {
        $this->initContainer($container);
        $this->configureContainer($container);
        $this->configureDIBuilder($this->getDIBuilder($container), $container);
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
        $this->configureApp($app);
        return $app;
    }
}
