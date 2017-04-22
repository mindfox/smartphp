<?php
namespace SmartPHP\Slim;

use Slim\App;
use SmartPHP\DefaultDIDefinitionProvider;
use SmartPHP\DI\DIDefinitionProviderInterface;
use SmartPHP\DI\DIDefinitionBuilderInterface;

class SlimAppBuilder implements DIDefinitionProviderInterface, SlimConfigProviderInterface, SlimRouteProviderInterface, SlimMiddlewareProviderInterface
{

    public static function create(DIDefinitionProviderInterface $diDefinitionProvider = null, SlimConfigProviderInterface $slimConfigProvider = null, SlimRouteProviderInterface $slimRouteProvider = null, SlimMiddlewareProviderInterface $slimMiddlewareProvider = null): SlimAppBuilder
    {
        return new static($diDefinitionProvider, $slimConfigProvider, $slimRouteProvider, $slimMiddlewareProvider);
    }

    /**
     *
     * @var DIDefinitionProviderInterface
     */
    private $defaultDIDefinitionProvider;

    /**
     *
     * @var DIDefinitionProviderInterface
     */
    private $diDefinitionProvider;

    /**
     *
     * @var SlimConfigProviderInterface
     */
    private $slimConfigProvider;

    /**
     *
     * @var SlimRouteProviderInterface
     */
    private $slimRouteProvider;

    /**
     *
     * @var SlimMiddlewareProviderInterface
     */
    private $slimMiddlewareProvider;

    private function __construct(DIDefinitionProviderInterface $diDefinitionProvider = null, SlimConfigProviderInterface $slimConfigProvider = null, SlimRouteProviderInterface $slimRouteProvider = null, SlimMiddlewareProviderInterface $slimMiddlewareProvider = null)
    {
        $this->defaultDIDefinitionProvider = DefaultDIDefinitionProvider::create();
        $this->diDefinitionProvider = $diDefinitionProvider ?? $this;
        $this->slimConfigProvider = $slimConfigProvider ?? $this;
        $this->slimRouteProvider = $slimRouteProvider ?? $this;
        $this->slimMiddlewareProvider = $slimMiddlewareProvider ?? $this;
    }

    public function build(): App
    {
        return new SlimApp($this->defaultDIDefinitionProvider, $this->diDefinitionProvider, $this->slimConfigProvider, $this->slimRouteProvider, $this->slimMiddlewareProvider);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\DI\DIDefinitionProviderInterface::configureDIDefinitions()
     */
    public function configureDIDefinitions(DIDefinitionBuilderInterface $diDefinitionBuilder)
    {
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Slim\SlimConfigProviderInterface::getConfig()
     */
    public function getConfig(): array
    {
        return [];
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Slim\SlimRouteProviderInterface::configureRoutes()
     */
    public function configureRoutes(App $app)
    {
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Slim\SlimMiddlewareProviderInterface::configureMiddlewares()
     */
    public function configureMiddlewares(App $app)
    {
    }
}
