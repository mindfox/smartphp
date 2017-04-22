<?php
namespace SmartPHP\Slim;

use DI\Bridge\Slim\App;
use DI\ContainerBuilder;
use SmartPHP\DI\DIDefinitionBuilder;
use SmartPHP\DI\DIDefinitionBuilderInterface;
use SmartPHP\DI\DIDefinitionProviderInterface;

class SlimApp extends App
{

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

    public function __construct(DIDefinitionProviderInterface $defaultDIDefinitionProvider, DIDefinitionProviderInterface $diDefinitionProvider, SlimConfigProviderInterface $slimConfigProvider, SlimRouteProviderInterface $slimRouteProvider, SlimMiddlewareProviderInterface $slimMiddlewareProvider)
    {
        $this->defaultDIDefinitionProvider = $defaultDIDefinitionProvider;
        $this->diDefinitionProvider = $diDefinitionProvider;
        $this->slimConfigProvider = $slimConfigProvider;
        $this->slimRouteProvider = $slimRouteProvider;
        $this->slimMiddlewareProvider = $slimMiddlewareProvider;
        parent::__construct();
        $this->configure();
    }

    private function configureDIDefinitionBuilder(DIDefinitionBuilderInterface $diDefinitionBuilder)
    {
        $diDefinitionBuilder->configure($this->defaultDIDefinitionProvider);
        $diDefinitionBuilder->configure($this->diDefinitionProvider);
    }

    private function configureSlimConfig(ContainerBuilder $builder)
    {
        $builder->addDefinitions($this->slimConfigProvider->getConfig());
    }

    private function configureDIDefinitions(ContainerBuilder $builder)
    {
        $diDefinitionBuilder = new DIDefinitionBuilder();
        $this->configureDIDefinitionBuilder($diDefinitionBuilder);
        $builder->addDefinitions($diDefinitionBuilder->getDefinitions());
    }
    
    private function configureApp(App $app)
    {
        $this->slimRouteProvider->configureRoutes($app);
        $this->slimMiddlewareProvider->configureMiddlewares($app);
    }
    
    private function configure()
    {
        $this->configureApp($this);
    }

    final protected function configureContainer(ContainerBuilder $builder)
    {
        $this->configureSlimConfig($builder);
        $this->configureDIDefinitions($builder);
    }
}
