<?php
namespace SmartPHP\Slim;

use Interop\Container\ContainerInterface;
use Slim\App;
use Slim\Container;

abstract class AppBuilder
{

    public static function create(): AppBuilder
    {
        return new static();
    }

    protected function createSettings(): array
    {
        return [];
    }

    protected function registerDependencies(ContainerInterface $container): AppBuilder
    {
        return $this;
    }

    protected function registerRoutes(App $app): AppBuilder
    {
        return $this;
    }

    protected function registerMiddlewares(App $app): AppBuilder
    {
        return $this;
    }

    public function build(): App
    {
        $app = new App($this->createSettings());
        $this->registerDependencies($app->getContainer())
            ->registerRoutes($app)
            ->registerMiddlewares($app);
        return $app;
    }
}
